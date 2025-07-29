<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;

class GoalController extends Controller
{
   
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('goals.index')->with('goals', $goals);

    }

    
    public function create()
    {
         return view('goals.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'saved_amount' => 'required|numeric|min:0',
            'deadline' => 'required|date',
        ]);

        Goal::create([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'saved_amount' => $request->saved_amount,
            'deadline' => $request->deadline,
            'user_id' => auth()->id(), // lo tomamos directamente del usuario autenticado
        ]);



        return redirect()->route('goals.index')->with('success', 'Meta creada correctamente.');
    }

    
    public function show(Goal $goal)
    {
        return view('goals.show', compact('goal'));
    }

    
    public function edit(Goal $goal)
    {
        $users = User::all();
        return view('goals.edit', compact('goal'));

    }

    
    public function update(Request $request, Goal $goal)
    {
       $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'saved_amount' => 'required|numeric|min:0',
            'deadline' => 'required|date',
        ]);

        $goal->update([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'saved_amount' => $request->saved_amount,
            'deadline' => $request->deadline,
    
        ]);


        return redirect()->route('goals.index')->with('success', 'Meta actualizada correctamente.');
    }

    
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Meta eliminada correctamente.');
    }
}