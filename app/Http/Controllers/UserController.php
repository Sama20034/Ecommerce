<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.user', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.edit', compact('user'));
    }

    public function account()
{
    $user = auth()->user(); // Get the currently authenticated user
    return view('dashboard.account', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    // Add validation for new fields
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Validating avatar
    ]);

    // Update user information
    $user->update([
        'first_name' => $validatedData['first_name'],
        'last_name' => $validatedData['last_name'],
        'email' => $validatedData['email'],
        'phone_number' => $validatedData['phone_number'] ?? $user->phone_number,
        'address' => $validatedData['address'] ?? $user->address,
    ]);

    // Handle avatar upload if a new one is uploaded
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => basename($path)]);
    }

    return redirect()->route('account')->with('success', 'Account updated successfully!');
}




public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}

public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->update(['status' => !$user->status]);

    return redirect()->route('users.index')->with('success', 'User status updated successfully.');
}
}
