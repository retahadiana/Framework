<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get recent users (most recently created or highest id)
        // The `user` table uses `iduser` as primary key and may not have timestamps.
        // Select the email instead of created_at to avoid missing column errors.
        $recentUsers = User::select(['iduser','nama','email'])
            ->orderByDesc('iduser')
            ->limit(6)
            ->get();

        return view('dashboard.admin', compact('recentUsers'));
    }
}
