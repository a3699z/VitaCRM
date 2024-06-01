<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use App\Http\Facades\Database;
use Illuminate\Support\Facades\Redirect;

class TeamsController extends Controller
{
    //

    public function index ()
    {
        $teams = Database::getReferences('teams');
        $teams = array_map (function ($item) {
            $item['employees_count'] = Database::countWhere('users', 'team_key', $item['key']);
            return $item;
        }, $teams);
        $teams = array_filter($teams);
        // dd($teams);
        return view('admin.teams.list', [
            'teams' => $teams,
            'emptyMessage' => 'No teams found.'
        ]);
    }

    public function show (Request $request, $key)
    {
        $team = Database::getOneReference('teams/'.$key);
        $team = (object) $team;
        $team->employees_count = Database::countWhere('users', 'team_key', $team->key);

        // dd($team);
        return view('admin.teams.detail', [
            'team' => $team
        ]);
    }

    public function delete (Request $request, $key)
    {
        Database::delete('teams/'.$key);
        return Redirect::route('admin.teams');
    }

    public function update (Request $request, $key)
    {
        $data = $request->all();
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('teams/'.$key, $data);

        return Redirect::route('admin.teams.show', ['key' => $key]);
    }

    public function create ()
    {
        return view('admin.teams.create');
    }

    public function store (Request $request)
    {
        $data = $request->all();
        // remove method and _token
        unset($data['_token']);
        unset($data['_method']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::push('teams', $data);

        return Redirect::route('admin.teams');
    }
}
