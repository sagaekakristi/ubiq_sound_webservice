<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SoundSetting;

class SoundSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fungsi = $request->input('fungsi');

        // SET VOLUME
        if($fungsi == 'set_volume'){
            $input_volume = intval($request->input('arg1'));

            $get_command = 'amixer -D pulse sget Master |grep % |awk \'{print $5}\'|sed -e \'s/\[//\' -e \'s/\]//\' | tail -n 1';
            $before_volume_result = exec($get_command);
            $before_volume_result = intval(str_replace('%', '', $before_volume_result));

            $set_command = 'amixer -D pulse sset Master '.$input_volume.'%';
            $set_result = exec($set_command);

            $current_volume_result = exec($get_command);
            $current_volume_result = intval(str_replace('%', '', $current_volume_result));

            return array(
                'status' => true,
                'data' => array(
                    'before_volume' => $before_volume_result,
                    'current_volume' => $current_volume_result,
                )
            );
        }

        // GET VOLUME
        else if ($fungsi == 'get_volume'){
            $get_command = 'amixer -D pulse sget Master |grep % |awk \'{print $5}\'|sed -e \'s/\[//\' -e \'s/\]//\' | tail -n 1';
            $current_volume_result = exec($get_command);
            $current_volume_result = intval(str_replace('%', '', $current_volume_result));

            return array(
                'status' => true,
                'data' => array(
                    'current_volume' => $current_volume_result,
                )
            );
        }

        // SET MUTE
        else if ($fungsi == 'set_mute'){
            $input_mute_status = $request->input('arg1');
            if($input_mute_status == 'true'){
                $input_mute_boolean = true;
            }
            else if($input_mute_status == 'false'){
                $input_mute_boolean = false;
            }
            else {
                return array(
                    'status' => false,
                    'msg' => 'Error: cannot recognize arg1 parameter',
                );
            }

            // get
            $get_command = 'amixer -D pulse sget Master |grep % |awk \'{print $6}\'|sed -e \'s/\[//\' -e \'s/\]//\' | tail -n 1';
            $get_result = exec($get_command);
            if($get_result == 'on'){
                $before_mute_status = false;
            }
            else if ($get_result == 'off'){
                $before_mute_status = true;
            }
            else {
                return array(
                    'status' => false,
                    'msg' => 'Webservice Error [001]: cannot recognize before mute status from command',
                    'data' => array(
                        'get_result' => $get_result,
                    ),
                );
            }

            // set
            if($input_mute_boolean == true){
                $set_command = 'amixer -D pulse sset Master mute';
            }
            else {
                $set_command = 'amixer -D pulse sset Master unmute';
            }
            $set_result = exec($set_command);

            // get
            $get_command = 'amixer -D pulse sget Master |grep % |awk \'{print $6}\'|sed -e \'s/\[//\' -e \'s/\]//\' | tail -n 1';
            $get_result = exec($get_command);
            if($get_result == 'on'){
                $current_mute_status = false;
            }
            else if ($get_result == 'off'){
                $current_mute_status = true;
            }
            else {
                return array(
                    'status' => false,
                    'msg' => 'Webservice Error [002]: cannot recognize before mute status from command',
                    'data' => array(
                        'get_result' => $get_result,
                    ),
                );
            }

            // return 
            return array(
                'status' => true,
                'data' => array(
                    'before_mute' => $before_mute_status,
                    'current_mute' => $current_mute_status,
                ),
            );

        }

        // GET MUTE
        else if ($fungsi == 'get_mute'){
            // get
            $get_command = 'amixer -D pulse sget Master |grep % |awk \'{print $6}\'|sed -e \'s/\[//\' -e \'s/\]//\' | tail -n 1';
            $get_result = exec($get_command);
            if($get_result == 'on'){
                $current_mute_status = false;
            }
            else if ($get_result == 'off'){
                $current_mute_status = true;
            }
            else {
                return array(
                    'status' => false,
                    'msg' => 'Webservice Error [001]: cannot recognize before mute status from command',
                    'data' => array(
                        'get_result' => $get_result,
                    ),
                );
            }

            // return
            return array(
                'status' => true,
                'data' => array(
                    'current_mute' => $current_mute_status,
                ),
            );
        }

        // SET EQUALIZER
        else if ($fungsi == 'set_equalizer'){
            $input_bass = intval($request->input('arg1'));
            $input_treble = intval($request->input('arg2'));
            $input_echo = intval($request->input('arg3'));

            $bass = SoundSetting::where('field', '=', 'bass')->first();
            $treble = SoundSetting::where('field', '=', 'treble')->first();
            $echo = SoundSetting::where('field', '=', 'echo')->first();

            $before_bass = $bass->value;
            $before_treble = $treble->value;
            $before_echo = $echo->value;

            $bass->value = $input_bass;
            $treble->value = $input_treble;
            $echo->value = $input_echo;

            $bass->save();
            $treble->save();
            $echo->save();

            $current_bass = $bass->value;
            $current_treble = $treble->value;
            $current_echo = $echo->value;

            return array(
                'before_bass' => $before_bass,
                'before_treble' => $before_treble,
                'before_echo' => $before_echo,
                
                'current_bass' => $current_bass,
                'current_treble' => $current_treble,
                'current_echo' => $current_echo,
            );
        }

        // GET EQUALIZER
        else if ($fungsi == 'get_equalizer'){
            $bass_setting = SoundSetting::where('field', '=', 'bass')->first();
            $treble_setting = SoundSetting::where('field', '=', 'treble')->first();
            $echo_setting = SoundSetting::where('field', '=', 'echo')->first();

            return array(
                'current_bass' => $bass_setting->value,
                'current_treble' => $treble_setting->value,
                'current_echo' => $echo_setting->value,
            );
        }

        else {
            return array(
                'status' => false,
                'msg' => 'Error: cannot recognize fungsi parameter',
                'data' => array(),
            );
        }
    }

    public function cron_on(Request $request)
    {
        $key = $request->input('key');
        if($key == 'stitch'){
            $h_on = $request->input('h_on');
            $m_on = $request->input('m_on');
            $service_call = 'curl \'localhost/index?fungsi=set_volume&id_device=0&jml_arg=1&arg1=10\'';
            $command = 'crontab -l | { cat; echo "'.$m_on.' '.$h_on.' * * * '.$service_call.'"; } | crontab -';
            $result_on = exec($command);

            $h_off = $request->input('h_off');
            $m_off = $request->input('m_off');
            $service_call = 'curl \'localhost/index?fungsi=set_volume&id_device=0&jml_arg=1&arg1=50\'';
            $command = 'crontab -l | { cat; echo "'.$m_off.' '.$h_off.' * * * '.$service_call.'"; } | crontab -';
            $result_off = exec($command);

            return array(
                'result_on' => $result_on,
                'result_off' => $result_off,
            );
        }
        else {
            return array(
                'message' => 'wrong key',
            );
        }
    }

    public function cron_reset(Request $request)
    {
        $key = $request->input('key');
        if($key == 'stitch'){
            $command = 'crontab -r';
            $result = exec($command);
            return array(
                'result' => $result,
            );
        }
        else {
            return array(
                'message' => 'wrong key',
            );
        }
    }
}
