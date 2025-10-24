<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    
    // Add your methods here, for example:
    public function index()
    {
        return view('LandingPage/home');
    }

    public function kontak(){
        return view('LandingPage/kontak');
    
    }

    public function layanan(){
        return view('LandingPage/layanan');
    
    }

    public function visi_misi(){
        return view('LandingPage/visi-misi');
    
    }

    public function struktur(){
        return view('LandingPage/struktur-organisasi');
    
    }
}
