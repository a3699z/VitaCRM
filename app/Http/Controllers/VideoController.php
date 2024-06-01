<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use App\Http\Facades\Database;
use App\Http\Facades\Auth;

class VideoController extends Controller
{
    //

    public function call(Request $request, $key) {
        $call = Database::getOneReference('calls/' . $key);
        $start_time = date('Y-m-d H:i:s', strtotime($call['date'] . ' ' . $call['hour']));
        $end_time = date('Y-m-d H:i:s', strtotime($call['date'] . ' ' . $call['hour'] . ' +1 hour'));
        $loggedin_user = Auth::getUserData();
        if ($loggedin_user['user_type'] == 'employee' && $call['employee_uid'] == $loggedin_user['uid']) {
            $call_with = Auth::getUserData($call['patient_uid']);
            // dd($call_with);
            return Inertia::render('Call/index', [
                'participant' => $loggedin_user,
                'otherPacticipant' => $call_with,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'callKey' => $key,
                'topic' => $call['topic'],
            ]);
        } else if ($loggedin_user['user_type'] == 'patient' && $call['patient_uid'] == $loggedin_user['uid']) {
            $call_with = Auth::getUserData($call['employee_uid']);
            return Inertia::render('Call/index', [
                'participant' => $loggedin_user,
                'otherPacticipant' => $call_with,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'callKey' => $key,
                'topic' => $call['topic'],
            ]);
        } else {
            return redirect()->route('site.index');
        }
    }

    public function api_call(Request $request, $key)
    {
        $call = Database::getOneReference('calls/' . $key);
        $config = \Patientus\OVS\SDK\Configuration::getDefaultConfiguration();
        $config->setHost('https://sandbox.patientus.de/');

        $authorization = new \Patientus\OVS\SDK\Handlers\AuthorizationHandler(
            $config
        );
        $authToken = $authorization->getAuthToken('vipvitalisten', '.2lH#GVr}X7p*rW7');
        $config->setAccessToken($authToken);
        $ovsSessionHandler = new \Patientus\OVS\SDK\Handlers\OvsSessionHandler(
            $config
        );
        if (Auth::getUID() == $call['employee_uid']) {
            $ovsSession = $ovsSessionHandler->getOvsSession(
                $call['room_name'],
                \Patientus\OVS\SDK\Consts\ParticipantType::MODERATOR
            );
        } else {
            $ovsSession = $ovsSessionHandler->getOvsSession(
                $call['room_name'],
                \Patientus\OVS\SDK\Consts\ParticipantType::PUBLISHER
            );
        }
        return response()->json($ovsSession);

    }
    public function index()
    {
        return Inertia::render('VideoComponent', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function video1 ()
    {
    $start_time = date('Y-m-d H:i:s', strtotime('+5 hours'));
    $end_time = date('Y-m-d H:i:s', strtotime('+6 hours'));
        return Inertia::render('VideoComponent', [
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
    }

    public function video1_api ()
    {
        $config = \Patientus\OVS\SDK\Configuration::getDefaultConfiguration();
        $config->setHost('https://sandbox.patientus.de/');

        $authorization = new \Patientus\OVS\SDK\Handlers\AuthorizationHandler(
            $config
        );

        $authToken = $authorization->getAuthToken('vipvitalisten', '.2lH#GVr}X7p*rW7');
        $config->setAccessToken($authToken);
        $ovsSessionHandler = new \Patientus\OVS\SDK\Handlers\OvsSessionHandler(
            $config
        );
        $ovsSession = $ovsSessionHandler->getOvsSession(
            'room_name',
            \Patientus\OVS\SDK\Consts\ParticipantType::MODERATOR
        );

        return response()->json($ovsSession);
    }

    public function video2 ()
    {
        $start_time = date('Y-m-d H:i:s', strtotime('+5 hours'));
        $end_time = date('Y-m-d H:i:s', strtotime('+6 hours'));
            return Inertia::render('VideoComponent2', [
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);
    }

    public function video2_api ()
    {
        $config = \Patientus\OVS\SDK\Configuration::getDefaultConfiguration();
        $config->setHost('https://sandbox.patientus.de/');

        $authorization = new \Patientus\OVS\SDK\Handlers\AuthorizationHandler(
            $config
        );

        $authToken = $authorization->getAuthToken('vipvitalisten', '.2lH#GVr}X7p*rW7');
        $config->setAccessToken($authToken);
        $ovsSessionHandler = new \Patientus\OVS\SDK\Handlers\OvsSessionHandler(
            $config
        );
        $ovsSession = $ovsSessionHandler->getOvsSession(
            'room_name',
            \Patientus\OVS\SDK\Consts\ParticipantType::PUBLISHER
        );

        return response()->json($ovsSession);
    }
}
