<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Test Index!';
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Test Create!';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Test Store!';
    }

    /**
     * Display the specified resource.
     */
    public function show(Habit $habit)
    {
        return 'Test Show!';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habit $habit)
    {
        return 'Test Edit!';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Habit $habit)
    {
        return 'Test Update!';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Habit $habit)
    {
        return 'Test Destroy!';
    }
}
