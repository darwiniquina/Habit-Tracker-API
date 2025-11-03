<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalHabits = Habit::where('user_id', $userId)->count();
        $totalLogs = HabitLog::whereHas('habit', fn ($q) => $q->where('user_id', $userId))->count();
        $completed = HabitLog::whereHas('habit', fn ($q) => $q->where('user_id', $userId))
            ->where('status', Status::DONE->value)
            ->count();

        return response()->json([
            'total_habits' => $totalHabits,
            'total_logs' => $totalLogs,
            'completed' => $completed,
            'completion_rate' => $totalLogs ? round(($completed / $totalLogs) * 100, 2) : 0,
        ]);
    }
}
