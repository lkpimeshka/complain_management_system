<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $guarded = array();


    public static function getActTypeName($type)
    {
        if ($type == 1) {
            return 'Assigned';
        } elseif ($type == 2) {
            return 'Completed';
        } elseif ($type == 3) {
            return 'Finished';
        } elseif ($type == 4) {
            return 'Re-Assigned';
        }
    }

}
