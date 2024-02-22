<?php

namespace App\Imports;

use App\Models\UserImport;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(empty($row[3])){
            $row[3] == NULL;
        }elseif($row[4]){
            $row[4] == NULL;
        }
        return new UserImport([
                'name'     => $row[0],
                'email'    => $row[1], 
                'phone'    => $row[2],
                'address'   => $row[3],
                'organization'=>$row[4]
        ]);
    }
   
}
