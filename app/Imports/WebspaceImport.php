<?php

namespace App\Imports;

use App\Webspace;
use Maatwebsite\Excel\Concerns\ToModel;

class WebspaceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Webspace([
            //
            'name' => $row[0],
            'url'  => $row[1],
            'status' => $row[2],
            'support' => $row[3],
            'platform' => $row[4],
            'owner' => $row[5],
            'department' => $row[6],
            'designation' => $row[7],
            'description' => $row[8],
        ]);
    }
}
