<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // You can pass data to the dashboard later
        $data = [
            'totalPosts' => 0,  // Replace with actual count later
            'totalDrafts' => 0,
            'totalStaff' => 0,
            'totalTrash' => 0,
        ];

        return view('admin.dashboard', $data);
    }
}
