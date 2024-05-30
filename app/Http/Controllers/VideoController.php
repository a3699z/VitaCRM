<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class VideoController extends Controller
{
    //
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

    public function video3 ()
    {
        return Inertia::render('VideoComponent3');
    }
}
