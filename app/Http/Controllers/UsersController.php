<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database

        return view('users.index', compact('users'));
    }
}
