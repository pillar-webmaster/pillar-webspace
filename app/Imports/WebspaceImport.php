<?php

namespace App\Imports;

use App\Webspace;
use App\Designation;
use App\Department;
use App\Owner;
use App\Platform;
use App\WebspaceMode as Mode;
use App\WebspaceSupportLevel as SupportLevel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\Validator;

class WebspaceImport implements OnEachRow, WithHeadingRow
{
    public function onRow (Row $row){
        //$multiple_email_regex = '/(([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)(\s*;\s*|\s*$))*/';
        $url_regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $the_data = $row->toArray();
        $the_data = $this->sanitize($the_data);

        $validator = Validator::make($the_data,
        [
            'name' => ['required','string', 'max:255'],
            'url' => ['required','regex:'.$url_regex, 'max:255'],
            'status' => ['required','string', 'max:15'],
            'support' => ['required','string', 'max:15'],
            'platform' => ['required','string', 'max:255'],
            'platform_version' => ['required', 'string', 'max:255'],
            'owner' => ['required','string'],
            'department' => ['required','string'],
            'designation' => ['required','string'],
            'owner_email' => ['required','string'],
            'description' => ['required','string', 'max:1000'],
        ],
        // :attribute is a placeholder for the input
        [
            'string' => 'The :attribute must be a string, error in line ' . $row->getIndex(),
            'required' => 'The :attribute is required, error in line ' . $row->getIndex(),
        ]
        )->validate();

        // make sure that each row  has correct index
        if ( count($the_data) == 11 ){
            // create designation
            $designationObj = $departmentObj = $ownerObj = $ownerEmailObj = [];
            $designations = explode("|", $the_data['designation']);
            $departments = explode("|", $the_data['department']);
            $owners = explode("|", $the_data['owner']);
            $ownerEmail = explode("|", $the_data['owner_email']);
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
            }
            // create platform
            $platform = Platform::firstOrCreate([
                'name' => $the_data['platform'],
                'version' => $the_data['platform_version'],
                'requirements' => '',
                'status' => 1,
            ]);
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

            // create entry to history
            $history = $webspace->histories()->create(['description' => "Profile created from imported CSV file"]);
        }
    }

    private function sanitize($input){
        // input fields here eg,
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['url'] = filter_var($input['url'], FILTER_SANITIZE_URL);
        $input['status'] = filter_var($input['status'], FILTER_SANITIZE_STRING);
        $input['support'] = filter_var($input['support'], FILTER_SANITIZE_STRING);
        $input['platform'] = filter_var($input['platform'], FILTER_SANITIZE_STRING);
        $input['platform_version'] = filter_var($input['platform_version'], FILTER_SANITIZE_STRING);
        $input['owner'] = filter_var($input['owner'], FILTER_SANITIZE_STRING);
        $input['department'] = filter_var($input['department'], FILTER_SANITIZE_STRING);
        $input['designation'] = filter_var($input['designation'], FILTER_SANITIZE_STRING);
        $input['owner_email'] = filter_var($input['owner_email'], FILTER_SANITIZE_STRING);
        $input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING);

        return $input;
    }
}
