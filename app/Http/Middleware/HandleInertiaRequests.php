<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Http\Facades\Auth;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user_data = Auth::check() ? Auth::getUserData() : null;


        // $uid = $_COOKIE['uid'];
        // dd($uid);

        // $user_data = Auth::getUserData($uid);
        // session()->put('uid', $uid);

        // dd($user_data);


        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user_data,
            ],

            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],

            // firebase erros
            'errors' => function () use ($request) {
                return $this->resolveValidationErrors($request);
            },


        ];
    }
}
