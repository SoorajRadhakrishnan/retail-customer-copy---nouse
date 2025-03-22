<?php

use App\Models\Admin\Customer;
use App\Models\Admin\Driver;
use App\Models\User;
use Illuminate\Support\Facades\DB;

if (!function_exists('getUserForFilter')) {
    function getUserForFilter($branch_id = null)
    {
        return User::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
        })
        ->where('usertype','counter')->get();
    }
}

if (!function_exists('getDriverForFilter')) {
    function getDriverForFilter($branch_id = null)
    {
        return Driver::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
        })->get();
    }
}

if (!function_exists('getCustomerForFilter')) {
    function getCustomerForFilter($branch_id = null)
    {
        return Customer::when($branch_id, function ($query,$branch_id) {
            $query->where('branch_id',$branch_id);
        })->get();
    }
}
