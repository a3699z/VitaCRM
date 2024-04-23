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

class EmployeeController extends Controller
{

    public function __construct( Database $database)
    {
        $this->database = $database;
    }

    public function store_fire (Request $request)
    {
        $newPost = $this->database
            ->getReference('blog/posts')
            ->push([
                'title' => 'Post title',
                'body' => 'This should probably be longer.'
            ]);

        return $newPost->getvalue();
    }
    /**
     * show all employees
     */

    public function index(): Response
    {
        $employees = User::where('user_type', 'employee')->get();
        return Inertia::render('Admin/Employees', [
            'employees' => $employees
        ]);
    }
    /**
     * store employee
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'employee'; // 'employee' or 'patient'
        $user->save();


        return Redirect::route('admin.employee.create');
    }

    /**
     * edit employee
     */

    public function edit($id): Response
    {
        $employee = User::find($id);
        return Inertia::render('Admin/EditEmployee', [
            'employee' => $employee
        ]);
    }

    /**
     * update employee
     */

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return Redirect::route('admin.employee.edit', ['id' => $id]);
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
