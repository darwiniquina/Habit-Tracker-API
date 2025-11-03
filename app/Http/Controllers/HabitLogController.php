<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitLog\CreateHabitLogRequest;
use App\Http\Requests\HabitLog\ShowHabitLogRequest;
use App\Http\Resources\HabitLogResource;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;

class HabitLogController extends Controller
{
    public function index(ShowHabitLogRequest $request, $id)
    {
        $habit = Habit::where('user_id', Auth::id())->find($id);
        $logs = $habit->logs()->latest()->get();

        return HabitLogResource::collection($logs);
    }

    public function store(CreateHabitLogRequest $request, $id)
    {
        $habit = Habit::where('user_id', Auth::id())->find($id);

        $log = $habit->logs()->create($request->validated());

        return HabitLogResource::make($log);
    }
}
