<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Multidevice;
use App\VolumeScale;
use App\Microphone;

class MultideviceController extends Controller
{
    /**
     * 
     */
    public function index(Request $request)
    {
        // validate
        $id_device = intval($request->input('id_device'));
        if(($id_device <= 7 && $id_device >= 1) == false){
            return array(
                'status' => false,
                'msg' => 'Error: id_device out of bound',
                'data' => NULL,
            );
        }

        //
        $fungsi = $request->input('fungsi');

        // SET VOLUME
        if($fungsi == 'set_volume'){
            // input
            $input_data = intval($request->input('arg1'));

            // process
            $old_data = Multidevice::where('id_device', '=', $id_device)
                ->where('field', '=', 'volume')
                ->first();
            $old_value = $old_data->value;
            $old_data->value = $input_data;
            $old_data->save();

            $new_data = Multidevice::where('id_device', '=', $id_device)
                ->where('field', '=', 'volume')
                ->first();
            $new_value = $new_data->value;

            // return
            return array(
                'status' => true,
                'data' => array(
                    'before_volume' => $old_value,
                    'current_volume' => $new_value,
                )
            );
        }
        // GET VOLUME
        else if ($fungsi == 'get_volume'){
            $new_data = Multidevice::where('id_device', '=', $id_device)
                ->where('field', '=', 'volume')
                ->first();
            $new_value = $new_data->value;

            $scale = VolumeScale::where('id_device', '=', $id_device)
                ->first()->value;

            $new_value = $new_value * $scale;

            // return
            return array(
                'status' => true,
                'data' => array(
                    'current_volume' => $new_value,
                )
            );
        }
        // SET MUTE
        else if ($fungsi == 'set_mute'){
            // input
            $input_data = $request->input('arg1');
            if($input_data == 'true'){
                $input_data = true;
            }
            else if($input_data == 'false'){
                $input_data = false;
            }
            else {
                return array(
                    'status' => false,
                    'msg' => 'Error: cannot recognize arg1 parameter',
                    'data' => array(
                        'arg1' => $input_data,
                    ),
                );
            }

            // process
            $old_data = Multidevice::where('id_device', '=', $id_device)
                ->where('field', '=', 'mute')
                ->first();
            $old_value = $old_data->value;
            $old_data->value = $input_data;
            $old_data->save();

            $new_data = Multidevice::where('id_device', '=', $id_device)
                ->where('field', '=', 'mute')
                ->first();
            $new_value = $new_data->value;

            // return
            return array(
                'status' => true,
                'data' => array(
                    'before_mute' => $old_value,
                    'current_mute' => $new_value,
                )
            );
        }
        // GET MUTE
        else if ($fungsi == 'get_mute'){
            $new_data = Multidevice::where('id_device', '=', $id_device)
                ->where('field', '=', 'mute')
                ->first();
            $new_value = $new_data->value;

            // return
            return array(
                'status' => true,
                'data' => array(
                    'current_mute' => $new_value,
                )
            );
        }
        // SET EQUALIZER
        else if ($fungsi == 'set_equalizer'){
            // input
            $input_bass = intval($request->input('arg1'));
            $input_treble = intval($request->input('arg2'));
            $input_echo = intval($request->input('arg3'));

            // process
            $old_bass_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'bass')->first();
            $old_treble_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'treble')->first();
            $old_echo_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'echo')->first();

            $old_bass = $old_bass_data->value;
            $old_treble = $old_treble_data->value;
            $old_echo = $old_echo_data->value;

            $old_bass_data->value = $input_bass;
            $old_treble_data->value = $input_treble;
            $old_echo_data->value = $input_echo;

            $old_bass_data->save();
            $old_treble_data->save();
            $old_echo_data->save();

            $new_bass_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'bass')->first();
            $new_treble_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'treble')->first();
            $new_echo_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'echo')->first();

            $new_bass = $new_bass_data->value;
            $new_treble = $new_treble_data->value;
            $new_echo = $new_echo_data->value;

            // return
            return array(
                'status' => true,
                'data' => array(
                    'before_bass' => $old_bass,
                    'before_treble' => $old_treble,
                    'before_echo' => $old_echo,
                    
                    'current_bass' => $new_bass,
                    'current_treble' => $new_treble,
                    'current_echo' => $new_echo,
                )
            );
        }
        // GET EQUALIZER
        else if ($fungsi == 'get_equalizer'){
            $new_bass_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'bass')->first();
            $new_treble_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'treble')->first();
            $new_echo_data = Multidevice::where('id_device', '=', $id_device)->where('field', '=', 'echo')->first();

            $new_bass = $new_bass_data->value;
            $new_treble = $new_treble_data->value;
            $new_echo = $new_echo_data->value;

            // return
            return array(
                'status' => true,
                'data' => array(
                    'current_bass' => $new_bass,
                    'current_treble' => $new_treble,
                    'current_echo' => $new_echo,
                )
            );
        }
        else {
            return array(
                'status' => false,
                'msg' => 'Error: cannot recognize fungsi parameter',
                'data' => array(
                    'fungsi' => $fungsi,
                ),
            );
        }
    }

    public function set_scale(Request $request) {
        $new_scale = $request->input('scale');
    	
    	for($i = 1; $i <= 7; $i++) {
	        $old_scale_data = VolumeScale::where('id_device', '=', $i)
	            ->first();
	        $old_scale_data->value = $old_scale_data->value * $new_scale;
	        $old_scale_data->save();
	}

	return array(
		'success' =>true,
	);
    }

    public function cron_on(Request $request)
    {
        $key = $request->input('key');
        if($key == 'stitch'){
            $h_on = $request->input('h_on');
            $m_on = $request->input('m_on');

            $result_on_data = array();
            $result_off_data = array();
            for($id_device = 1; $id_device <= 7; $id_device++){
                $service_call = 'curl \'localhost/index?fungsi=set_volume&id_device='.$id_device.'&jml_arg=1&arg1=10\'';
                $command = 'crontab -l | { cat; echo "'.$m_on.' '.$h_on.' * * * '.$service_call.'"; } | crontab -';
                $result_on = exec($command);
                $result_on_data[$id_device] = $result_on;

                $h_off = $request->input('h_off');
                $m_off = $request->input('m_off');
                $service_call = 'curl \'localhost/index?fungsi=set_volume&id_device='.$id_device.'&jml_arg=1&arg1=50\'';
                $command = 'crontab -l | { cat; echo "'.$m_off.' '.$h_off.' * * * '.$service_call.'"; } | crontab -';
                $result_off = exec($command);
                $result_off_data[$id_device] = $result_off;
            }

            return array(
                'status' => true,
                'data' => array(
                    'result_on' => $result_on_data,
                    'result_off' => $result_off_data,
                ),
            );
        }
        else {
            return array(
                'status' => true,
                'msg' => 'wrong key',
                'data' => NULL,
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
                'status' => true,
                'data' => array(
                    'result' => $result,
                ),
            );
        }
        else {
            return array(
                'status' => false,
                'msg' => 'wrong key',
                'data' => NULL,
            );
        }
    }

    public function ui(Request $request) {
        $volume = array();
        $mute = array();
        $bass = array();
        $treble = array();
        $echo = array();

        for($i = 1; $i <= 7; $i++) {
            $responseVolume = json_decode(exec('curl "localhost/index?fungsi=get_volume&id_device='.$i.'&jml_arg=0"'), true);
            $responseMute = json_decode(exec('curl "localhost/index?fungsi=get_mute&id_device='.$i.'&jml_arg=0"'), true);
            $responseEqualizer = json_decode(exec('curl "localhost/index?fungsi=get_equalizer&id_device='.$i.'&jml_arg=0"'), true);
            $volume[$i-1] = $responseVolume['data']['current_volume'];
            if($responseMute['data']['current_mute']) {
                $mute[$i-1] = "Mute";   
            }
            else {
                $mute[$i-1] = "Not Mute";
            }
            $bass[$i-1] = $responseEqualizer['data']['current_bass'];
            $treble[$i-1] = $responseEqualizer['data']['current_treble'];
            $echo[$i-1] = $responseEqualizer['data']['current_echo'];
        }

        $checked = Microphone::where('id', '=', 1)->first()->value;

        return view('sound')
            ->with('volume', $volume)
            ->with('mute', $mute)
            ->with('bass', $bass)
            ->with('treble', $treble)
            ->with('echo', $echo)
            ->with('checked', $checked);
    }

    public function configureUI(Request $request) {
        $id_device = $request->input('speaker');
        $new_volume = $request->input('volume');
        $new_mute = $request->input('mute');
        $new_bass = $request->input('bass');
        $new_treble = $request->input('treble');
        $new_echo = $request->input('echo');

        exec('curl "localhost/index?fungsi=set_volume&id_device='.$id_device.'&jml_arg=1&arg1='.$new_volume.'"');

        if($new_mute == "Mute") {
            $new_mute = 'true';
        }
        else {
            $new_mute = 'false';
        }

        exec('curl "localhost/index?fungsi=set_mute&id_device='.$id_device.'&jml_arg=1&arg1='.$new_mute.'"');
        exec('curl "localhost/index?fungsi=set_equalizer&id_device='.$id_device.'&jml_arg=3&arg1='.$new_bass.'&arg2='.$new_treble.'&arg3='.$new_echo.'"');

        return redirect()->action('MultideviceController@ui');
    }

    public function microphoneUI(Request $request) {
            $new_scale = $request->input('scale');
            $new_checkbox = $request->input('checked');

            for($i = 1; $i <= 7; $i++) {
                $old_scale_data = VolumeScale::where('id_device', '=', $i)
                    ->first();
                $old_scale_data->value = $old_scale_data->value * $new_scale;
                $old_scale_data->save();
            }

            $old_checked_data = Microphone::where('id', '=', 1)->first();
            $old_checked_data->value = $new_checkbox;
            $old_checked_data->save();

            return redirect()->action('MultideviceController@ui');
    }
}
