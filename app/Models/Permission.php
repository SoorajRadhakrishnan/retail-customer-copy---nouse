<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    public static function get_usertype_settings($user_type)
    {
        return DB::table('permissions')->where('parent_id', '0')->where('usertype', '=', $user_type)->whereNull('deleted_at')->get();
    }

    public static function get_sub_settings($parent_id)
    {
        return DB::table('permissions')->where('parent_id', '=', $parent_id)->whereNull('deleted_at')->get();
    }

    public static function getUserPermissions($user_id)
    {
        $values = array();
        $result =  DB::table('user_has_permissions')->where('user_id', $user_id)->get('action');
        foreach ($result as $val)
        {
            $values[] = $val->action;
        }
        return $values;
    }
}
