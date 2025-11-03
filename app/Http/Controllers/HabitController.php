<?php

namespace App\Http\Controllers;

use App\Http\Requests\Habit\CreateHabitRequest;
use App\Http\Requests\Habit\DestroyHabitRequest;
use App\Http\Requests\Habit\ShowHabitRequest;
use App\Http\Requests\Habit\UpdateHabitRequest;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    public function index()
    {
        return HabitResource::collection(Habit::all());
    }

    public function store(CreateHabitRequest $request)
    {
        $habit = $request->validated();
        $habit['user_id'] = Auth::id();

        $habit = Habit::create($habit);

        return HabitResource::make($habit);
    }

    public function show(ShowHabitRequest $request)
    {
        $habit = Habit::find($request->route('id'));

        return HabitResource::make($habit);
    }

    public function update(UpdateHabitRequest $request, $id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);
        $habit->update($request->validated());

        return HabitResource::make($habit);
    }

    public function destroy(DestroyHabitRequest $request, $id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);
        $habit->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Habit archived successfully',
        ]);
    }
}
