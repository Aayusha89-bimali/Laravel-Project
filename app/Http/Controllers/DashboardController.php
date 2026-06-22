<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'   => User::count(),
            'admins'  => User::where('role', 'admin')->count(),
            'users'   => User::where('role', 'user')->count(),
            'monthly' => User::whereMonth('created_at', now()->month)->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}