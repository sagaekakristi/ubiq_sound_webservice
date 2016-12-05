<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoundSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sound_system_settings')->insert([
            'field' => 'bass',
            'value' => 0,
        ]);

        DB::table('sound_system_settings')->insert([
            'field' => 'treble',
            'value' => 0,
        ]);

        DB::table('sound_system_settings')->insert([
            'field' => 'echo',
            'value' => 0,
        ]);
    }
}
