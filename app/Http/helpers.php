<?php

use App\Models\Countries;


    function getCountries($title = null)
    {
        $countries = Countries::where('status', 'Active')->orderBy('name')->pluck('name', 'id');
        return $countries;
    }

    // function getGenrelStatus($status = null, $type= null)
    // {
    //     if(isset($type)) {
    //         $response = [
    //                 '1' => '<span class="badge badge-soft-success">Active</span>'    ,
    //                 '2' => '<span class="badge badge-soft-warning">Inactive</span>'
    //             ];
    //     } else {
    //         $response = [
    //                 '1' => 'Active'    ,
    //                 '2' => 'Inactive'
    //             ];
    //     }
    //     if(isset($status) && $status != null) {
    //         return $response[$status];
    //     } else {
    //         return $response;
    //     }
    // }

    function userTitles($title = null)
    {
        $title = [
            'Mr' => 'Mr'    ,
            'Mrs' => 'Mrs'    ,
            'Miss' => 'Miss'  ,
            'Doctor' => 'Doctor',
        ];

        return $title;
    }

    function membershipType($type = null)
    {
        $type = [
            'Ordinary' => 'Ordinary',
            'Honorary Foundation' => 'Honorary Foundation',
            'Honorary Executive' => 'Honorary Executive',
        ];

        return $type;
    }

    function emergencyRelation($type = null)
    {
        $type = [
            'Husband' => 'Husband',
            'Wife' => 'Wife',
            'Partner' => 'Partner',
            'Father' => 'Father',
            'Mother' => 'Mother',
            'Sister' => 'Sister',
            'Brother' => 'Brother',
            'Friend' => 'Friend',
            'Colleague' => 'Colleague',
        ];

        return $type;
    }

    function membershipStatus($status = null, $type= null)
    {
        if(isset($type)) {
            $response = [
                'Active' => '<span class="badge badge-soft-info">Active</span>',
                'Dominant' => '<span class="badge badge-soft-success">Dominant</span>',
                'Inactive' => '<span class="badge badge-soft-warning">Inactive</span>',
                'Expired' => '<span class="badge badge-soft-danger">Expired</span>'
            ];
        } else {
            $response = [
                'Active' => 'Active',
                'Dominant' => 'Dominant',
                'Inactive' => 'Inactive',
                'Expired' => 'Expired',
            ];
        }

        if(isset($status) && $status != null) {
            return $response[$status];
        } else {
            return $response;
        }
    }

    function status($status = null)
    {
        $status = [
            'Yes' => 'Yes',
            'No' => 'No',
        ];

        return $status;
    }

    function getProductSize($status = null, $type= null)
    {
        if(isset($type)) {
            $response = [
                    '1' => '<span class="badge badge-soft-info">Small</span>'    ,
                    '2' => '<span class="badge badge-soft-success">Medium</span>'   ,
                    '2' => '<span class="badge badge-soft-warning">Large</span>'   ,
                ];
        } else {
            $response = [
                    '1' => 'Small'  ,
                    '2' => 'Medium' ,
                    '3' => 'Large'  ,
                ];
        }
        if(isset($status) && $status != null) {
            return $response[$status];
        } else {
            return $response;
        }
    }

    // function getProductTypes($per = null)
    // {
    //     $response = [
    //             '1' => 'Wearable',
    //             '2' => 'Placeable',
    //             '3' => 'Accessories'
    //         ];

    //     return $response;
    // }

    // function getColors($status = null)
    // {
    //     $response = [
    //             '1' => '#000000'  ,
    //             '2' => '#00eeff' ,
    //             '3' => '#001234'  ,
    //         ];

    //     return $response;
    // }

    // function getGenders($status = null)
    // {
    //     $response = [
    //             '1' => 'Male',
    //             '2' => 'Female',
    //             '3' => 'Unisex'
    //         ];

    //     return $response;
    // }

    function getOfferStatus($status = null)
    {
        $response = [
                '1' => 'Pending'    ,
                '2' => 'Withdraw'   ,
                '3' => 'Accept'     ,
                '4' => 'Reject'
            ];
        if(isset($status) && $status != null) {
            return $response[$status];
        } else {
            return $response;
        }
    }

    function getTicketStatus($status = null)
    {
        $response = [
                '1' => 'Approved',
                '2' => 'Pending',
                '3' => 'Rejected'
            ];
        if(isset($status) && $status != null) {
            return $response[$status];
        } else {
            return $response;
        }
    }

    function getPermission($per = null)
    {
        $response = [
                '1' => 'Allowed',
                '2' => 'Not Allowed'
            ];
        if(isset($per) && $per != null) {
            return $response[$per];
        } else {
            return $response;
        }
    }

    function convertFileSize($bytes, $decimals = 2){ // FILE SIZE
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

?>
