<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard overview.
     */
    public function index()
    {
        // Contoh data statistik - bisa diganti dengan data real
        $stats = [
            'total_revenue' => 12500000,
            'total_orders' => 258,
            'new_customers' => 42,
            'conversion_rate' => 24.8
        ];

        return view('dashboard.main.index', compact('stats'));
    }
}
