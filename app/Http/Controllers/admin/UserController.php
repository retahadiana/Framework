<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::with('role')->get();
        return view('user.index', compact('data'));
    }
}
