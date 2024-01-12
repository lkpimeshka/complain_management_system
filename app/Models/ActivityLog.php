<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';
    protected $guarded = array();


    public static function createLog($log, $userId)
    {
        self::create([
            'log' => $log,
            'created_by' => $userId,
        ]);

        return;
    }

}
