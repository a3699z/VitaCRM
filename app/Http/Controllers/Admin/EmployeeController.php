<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
// suer firebase databse
use  Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
// firebase fail to create user
use Kreait\Firebase\Exception\Auth\EmailExists;

class EmployeeController extends Controller
{

    protected $database;
    protected $auth;
    public function __construct( Database $database, FirebaseAuth $auth)
    {
        $this->database = $database;
        $this->auth = $auth;
    }

    public function store_team(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $team = [
            'name' => $request->name,
        ];

        $this->database->getReference('teams')->push($team);

        return Redirect::route('admin.team.create');
    }

    public function edit_team ($key): Response
    {
        $team = $this->database->getReference('teams/'.$key)->getValue();
        $team['key'] = $key;
        return Inertia::render('Admin/EditTeam', [
            'team' => $team
        ]);
    }

    public function update_team(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $team = [
            'name' => $request->name,
        ];

        $this->database->getReference('teams/'.$request->key)->update($team);

        return Redirect::route('admin.team.edit', ['key' => $request->key]);
    }

    public function index_team(): Response
    {
        $teams = $this->database->getReference('teams')->getValue();
        if (!empty($teams)) {
            $teams = array_map(function($team, $key) {
                return [
                    'key' => $key,
                    'name' => $team['name'],
                ];
            }, $teams, array_keys($teams));
        } else {
            $teams = [];
        }
        return Inertia::render('Admin/Teams', [
            'teams' => $teams
        ]);
    }
    /**
     * show all employees
     */

     public function create (): Response
     {
        // get all teams
        $teams = $this->database->getReference('teams')->getValue();
        $teams = array_map(function($team, $key) {
            return [
                'key' => $key,
                'name' => $team['name'],
            ];
        }, $teams, array_keys($teams));
         return Inertia::render('Admin/CreateEmployee', [
             'teams' => $teams
         ]);
     }

     public function show_team ($key): Response
     {
        $team = $this->database->getReference('teams/'.$key)->getValue();
        $team['key'] = $key;
        $employees_arr = $this->database->getReference('users')->orderByChild('team_key')->equalTo($key)->getValue();
        $reservations = [];
        $employees = [];
        if (!empty($employees_arr)) {
            foreach ($employees_arr as $employee_key => $employee) {
                $employee['key'] = $employee_key;
                $employee_reservations = $this->database->getReference('reservations')->orderByChild('employee_key')->equalTo($employee_key)->getValue();
                if (!empty($employee_reservations)) {
                    $employee_reservations = array_map(function($reservation, $key){
                        $reservation['key'] = $key;
                        $reservation['patient'] = $this->database->getReference('users/'.$reservation['user_key'])->getValue();
                        $reservation['employee'] = $this->database->getReference('users/'.$reservation['employee_key'])->getValue();
                        return $reservation;
                    }, $employee_reservations, array_keys($employee_reservations));
                    $reservations = array_merge($reservations, $employee_reservations);
                }
                $employees[] = $employee;
            }
        }
        // dd($reservations);

        return Inertia::render('Admin/ShowTeam', [
            'team' => $team,
            'employees' => $employees,
            'reservations' => $reservations
        ]);
     }

     public function delete_team ($key): RedirectResponse
     {
        //  $request->validate([
        //      'key' => ['required', 'string'],
        //  ]);
        //  dd($key);
         $this->database->getReference('teams/'.$key)->remove();

         return Redirect::route('admin.teams');
     }

    public function index(): Response
    {

        $employees = $this->database->getReference('users')->orderByChild('user_type')->equalTo('employee')->getValue();
        $employees = array_map(function($employee, $key) {
            return [
                'key' => $key,
                'uid' => $employee['uid'],
                'name' => $employee['name'],
                'email' => $employee['email'],
            ];
        }, $employees, array_keys($employees));
        return Inertia::render('Admin/Employees', [
            'employees' =>$employees
        ]);
    }
    /**
     * store employee
     */

    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8'],
        // ]);

        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->user_type = 'employee'; // 'employee' or 'patient'
        // $user->save();
            // dd($request->team_key);
        try {
            $email = $request->email;
            $password = $request->password;
            $userProperties = [
                'email' => $email,
                'password' => $password,
                'displayName' => $request->name,
            ];
            $firebase_user = $this->auth->createUser($userProperties);
            // if fibase user created successfully then save the user in the database

        } catch (EmailExists $e) {
            return back()->withErrors(['email' => 'The provided email is already registered.']);
        }
            if ($firebase_user) {
                $user = [
                    'uid' => $firebase_user->uid,
                    'name' => $request->name,
                    'email' => $email,
                    'user_type' => 'employee',
                    'team_key' => $request->team_key,
                ];
                $user = $this->database->getReference('users')->push($user);
            }


        return Redirect::route('admin.employee.create');
    }

    /**
     * edit employee
     */

    public function edit($uid): Response
    {
        $employee = new User();
        $employee = $employee->getByUID($uid);

        $teams = $this->database->getReference('teams')->getValue();
        if (!empty($teams)) {
            $teams = array_map(function($team, $key) {
                return [
                    'key' => $key,
                    'name' => $team['name'],
                ];
            }, $teams, array_keys($teams));
        } else {
            $teams = [];
        }
        return Inertia::render('Admin/EditEmployee', [
            'employee' => $employee,
            'teams' => $teams
        ]);
    }

    /**
     * update employee
     */

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        try {
            $user = $this->auth->getUser($request->uid);
            $userProperties = [
                'email' => $request->email,
                'displayName' => $request->name,
            ];
            $this->auth->updateUser($request->uid, $userProperties);

            $user = new User();
            $user = $user->getByUID($request->uid);
            $key = $user['key'];
            $user = [
                'uid' => $request->uid,
                'name' => $request->name,
                'email' => $request->email,
                'user_type' => 'employee',
                'team_key' => $request->team_key,
            ];
            $this->database->getReference('users/'.$key)->update($user);


        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }


        return Redirect::route('admin.employee.edit', ['uid' => $request->uid]);
    }

    /**
     * delete employee
     */

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $user = User::find($request->id);
        $user->delete();

        return Redirect::route('admin.employees');
    }

}
