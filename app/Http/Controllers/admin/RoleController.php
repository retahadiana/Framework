<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::all();
        return view('admin.role.index', compact('data'));
    }
}
