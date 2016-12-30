<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolumeScale extends Model
{
    //
    protected $table = 'sound_system_volume_scale';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
