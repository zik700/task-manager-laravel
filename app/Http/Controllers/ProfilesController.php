<?php

namespace App\Http\Controllers;

use App\User;
use App\Tasks;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user)
    {
        
        // $tasks = Tasks::find();
        $user = User::find($user);
        return view('home', [
            'user' => $user,
        ]);
    }

    function get_user_data($user){
        return User::find($user);
    }

    function get_user_tasks($user){

    }

}
