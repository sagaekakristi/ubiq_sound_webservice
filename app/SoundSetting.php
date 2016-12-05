<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoundSetting extends Model
{
    //
    protected $table = 'sound_system_settings';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
