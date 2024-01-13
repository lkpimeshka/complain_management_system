<?php

namespace App\Models;

use App\Models\RolePrivilege;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $table = 'privileges';
    protected $guarded = array();

    public static function checkPrivilege($privilege)
    {
        $user = Auth::user();

        if($user->role == 1 || $user->role == 2 || $user->role == 3){
            return true;
        }

        $rolePrivilege = RolePrivilege::where('role_id', $user->role)->first();
            if ($rolePrivilege) {
                $privileges = json_decode($rolePrivilege->privileges);
                return in_array($privilege, $privileges);
            } else {
                return false;
            } 
    }

}
