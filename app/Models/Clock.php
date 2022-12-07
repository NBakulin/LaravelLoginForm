<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;

class Clock
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'time',
        'last_update_timestamp',
    ];
}
