<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Countries;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            // dd($row[20]);
            $countryName = $row[20]; 
            // dd($countryName);
            $country = Countries::where('name', 'LIKE', $countryName)->select('id')->first();
            if ($country) {
                $countryId = $country->id;
            } else {
                $countryId = null;
            }


            User::create([
                // Modify the following fields based on your Excel column names
                'title' => $row[0],
                'first_name' => $row[1],
                'last_name' => $row[2],
                'mobile_number' => $row[3],
                'emergency_relation' => $row[4],
                'emergency_name' => $row[5],
                'emergency_number' => $row[6],
                'email' => $row[7],
                'date_of_birth' => date('Y-m-d', strtotime($row[8])),
                'registration_date' => date('Y-m-d', strtotime($row[9])),
                'occupation' => $row[10],
                'party_position' => $row[11],
                'branch' => $row[12],
                'chapter' => $row[13],
                'membership_type' => $row[14],
                'volunteer' => $row[15],
                'address' => $row[16],
                'city' => $row[17],
                'state' => $row[18],
                'zipcode' => $row[19],
                'country' => $countryId,
                'note' => $row[21],
                'password' => \Hash::make($row[22]),
            ]);
        }
    }
}