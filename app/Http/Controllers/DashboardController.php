<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Field;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard overview.
     */
    public function index()
    {
        // Data real dari database
        $stats = [
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'total_orders' => Booking::count(),
            'new_customers' => User::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'total_fields' => Field::count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
        ];

        // Data untuk chart pendapatan bulanan
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Payment::where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
            $monthlyRevenue[] = $revenue / 1000000; // Convert to million rupiah
        }

        // Data untuk chart kategori lapangan
        $fieldCategories = Field::selectRaw('type, COUNT(*) as count')
            ->whereNotNull('type')
            ->where('type', '!=', '')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type')
            ->toArray();

        // Jika tidak ada data, berikan data default
        if (empty($fieldCategories)) {
            $fieldCategories = [
                'Futsal' => 3,
                'Basket' => 2,
                'Badminton' => 1,
            ];
        }

        // Booking terbaru
        $recentBookings = Booking::with(['user', 'field', 'payment'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.main.index', compact('stats', 'monthlyRevenue', 'fieldCategories', 'recentBookings'));
    }
}
