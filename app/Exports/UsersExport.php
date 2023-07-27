<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with('countries:name')
        ->leftJoin('countries', 'users.country', '=', 'countries.id')
        ->where('users.user_type', 2)
        ->select('users.id', 'users.status', 'users.title', 'users.first_name', 'users.last_name', 'users.mobile_number', 'users.emergency_relation', 'users.emergency_relation', 'users.emergency_name', 'users.emergency_number', 'users.email', 'users.date_of_birth', 'users.registration_date', 'users.occupation', 'users.party_position', 'users.branch', 'users.chapter', 'users.membership_type', 'users.volunteer', 'users.address', 'users.city', 'users.state', 'users.zipcode', 'countries.name as country', 'users.note')
        ->get();
    }
}
