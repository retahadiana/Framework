<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::with('user')->get();
        return view('admin.datapemilik.index', compact('data'));
    }
}
