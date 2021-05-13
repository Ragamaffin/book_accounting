<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRole;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with('role')->get();
        $user_role = new UserRole();
        foreach ($users as $user){
            if ($user->id == Auth::user()->id) {
                $user_role = $user;
            }
        }

        unset($users);
        return view('home',['user_role' => $user_role]);
    }
}
