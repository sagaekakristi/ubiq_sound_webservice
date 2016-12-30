<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Microphone extends Model
{
    //
    protected $table = 'sound_system_microphone';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
