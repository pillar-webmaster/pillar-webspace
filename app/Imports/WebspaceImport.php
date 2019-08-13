<?php

namespace App\Imports;

use App\Webspace;
use App\Designation;
use App\Department;
use App\Owner;
use App\Platform;
use App\WebspaceMode as Mode;
use App\WebspaceSupportLevel as SupportLevel;
use Session;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\Validator;



class WebspaceImport implements OnEachRow, WithHeadingRow
{
    public function onRow (Row $row){

        //dd($row->toArray());
        $multiple_email_regex = '/(([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)(\s*;\s*|\s*$))*/';
        $validator = Validator::make($row->toArray(), 
        [
            'owneremail' => ['required','regex:'.$multiple_email_regex],
        ]
        )->validate();

        
        /*$this->errors = new \Illuminate\Support\MessageBag;
        if ($validator->fails()) {
            //dd($validator);
            Session::flash('error', 'have error');
            return redirect('webspace.import')->withErrors($validator);
        }*/

        $the_data = $row->toArray();
        // make sure that each row  has correct index
        if ( count($the_data) == 11 ){
            // create designation
            $designationObj = $departmentObj = $ownerObj = $ownerEmailObj = [];
            $designations = explode(";", $the_data['designation']);
            $departments = explode(";", $the_data['department']);
            $owners = explode(";", $the_data['owner']);
            $ownerEmail = explode(";", $the_data['owneremail']);
            // check if designation, department and owner have equal quantity
            if ( ( count($designations) == count($departments) ) &&
                (count($departments) == count($owners) )  &&
                (count($owners) == count($ownerEmail) )){
                // create designation
                foreach ($designations as $designation){
                    $designationObj[] = Designation::firstOrCreate([
                        'name' => $designation,
                        'status' => 1
                    ]);
                }
                // create department
                foreach ($departments as $department){
                    $departmentObj[] = Department::firstOrCreate([
                        'name' => $department,
                        'status' => 1
                    ]);
                }
                // create owner
                $i = 0;
                foreach ($owners as $owner){
                    $ownerObj[] = Owner::firstOrCreate([
                        'name' => $owner,
                        'contact' => '',
                        'email' => $ownerEmail[$i],
                        'designation_id' => $designationObj[$i]->id,
                        'department_id' => $departmentObj[$i]->id,
                        'status' => 1
                    ]);
                    $i++;
                }
                // create platform
                $platform = Platform::firstOrCreate([
                    'name' => $the_data['platform'],
                    'version' => $the_data['platform_version'],
                    'requirements' => '',
                    'status' => 1,
                ]);
                }
            // create webspace
            $mode = new Mode();
            $support = new SupportLevel();

            $webspace = Webspace::firstOrCreate([
                'name' => $the_data['name'],
                'url' => $the_data['url'],
                'mode' => array_search($the_data['status'],$mode->all('mode')),
                'service' => array_search($the_data['support'],$support->all('support_level')),
                'platform_id' => $platform->id,
                'description' => $the_data['description'],
                'status' => 1,
            ]);

            // link owners to webspace
            foreach ($ownerObj as $obj){
                $owner_webspace = $webspace->owners()->syncWithoutDetaching($obj);
            }
        }
    }
}
