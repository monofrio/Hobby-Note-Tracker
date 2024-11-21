<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
//    public function index(): View
//    {
//        return view('chirps.index', [
//            'chirps' => Chirp::with('user')->latest()->get(),
//        ]);
//    }
    public function index()
    {
        // Fetch all Chirps
//        $chirps = Chirp::all();
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);

        // Pass the chirps to the dashboard view
        return view('dashboard', compact('chirps'));
    }


    public function dashboard()
    {
        $batches = \App\Models\Plant::select('batch_number')
            ->selectRaw('COUNT(*) as total_plants')
            ->groupBy('batch_number')
            ->get();

        return view('dashboard', compact('batches'));
    }



}

