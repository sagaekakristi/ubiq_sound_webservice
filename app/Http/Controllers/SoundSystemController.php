<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        // GET EQUALIZER

        else {
            return array(
                'status' => false,
                'msg' => 'Error: cannot recognize fungsi parameter',
                'data' => array(),
            );
        }
    }
}
