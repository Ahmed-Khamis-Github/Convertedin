<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;


class StatisticsController extends Controller
{
    public function index()
    {
        // Fetch total tasks, admins, and users
        $totalTasks = Task::count();
        $totalAdmins = Admin::count();
        $totalUsers = User::count();

        // Fetch the top 10 users with the highest task count
        $topUsers = Statistics::orderByDesc('task_count')->limit(10)->with('user')->get();

        return view('dashboard.statistics.index', compact('totalTasks', 'totalAdmins', 'totalUsers', 'topUsers'));
    }
}
