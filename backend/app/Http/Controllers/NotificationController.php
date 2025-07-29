<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    public function index()
    {
        $notifications = Notification::with('user')->get();
        return view('notifications.index', compact('notifications'));
    }

    
    public function create()
    {
        $users = User::all();
        return view('notifications.create', compact('users'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'date' => 'required|date',
            'read' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        Notification::create($request->all());

        return redirect()->route('notifications.index')->with('success', 'Notificación creada correctamente.');
    }

    
    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    
    public function edit(Notification $notification)
    {
        $users = User::all();
        return view('notifications.edit', compact('notification', 'users'));
    }

    
    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'date' => 'required|date',
            'read' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        $notification->update($request->all());

        return redirect()->route('notifications.index')->with('success', 'Notificación actualizada correctamente.');
    }

    
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notificación eliminada correctamente.');
    }
}



