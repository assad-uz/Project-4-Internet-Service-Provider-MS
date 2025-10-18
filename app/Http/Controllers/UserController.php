<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. users.index: Show list of users
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('pages.admin.users.index', compact('users'));
    }

    // 2. users.create: Show form for creating new user
    public function create()
    {
        return view('pages.admin.users.create');
    }

    // 3. users.store: Save data from the creation form
    public function store(Request $request)
    {
        // Validation logic
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        // Hash password and save to database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    // 4. users.show: (Optional) Show user details
    public function show(User $user)
    {
        // For simplicity, we are skipping a dedicated show view.
        return redirect()->route('users.index');
    }

    // 5. users.edit: Show the edit form for an existing user
    public function edit(User $user)
    {
        // Sending existing user data to the view using Route Model Binding
        return view('pages.admin.users.edit', compact('user'));
    }

    // 6. users.update: Update the user data
    public function update(Request $request, User $user)
    {
        // Validation. Ignore current user's email for unique check.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Password is optional on edit
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        // Logic to hash password only if it is provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Remove password from validated data if not provided
            unset($validatedData['password']);
        }

        // Update user data in the database
        $user->update($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    // 7. users.destroy: Delete the user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
