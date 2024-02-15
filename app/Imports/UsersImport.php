<?php

namespace App\Imports;

use App\Models\UserImport;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserImport([
                'name'     => $row['Name'],
                'email'    => $row['Email'], 
                'phone'    => $row['Phone'],
                'address'   => $row['Address'],
                'organization'=>$row['Organization']
        ]);
    }
}
