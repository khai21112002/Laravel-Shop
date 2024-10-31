<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class ManageUser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(3);
        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function UserExists($data)
    {
        return User::where('email', $data['email'])
        ->exists();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Request data', $request->all());

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:15',
                'password' => 'required|string|min:8',
                'role' => 'required|in:user,admin'
            ]);

            $validated['role'] = $validated['role'] === 'admin' ? 1 : 0;
            $validated['password'] = bcrypt($validated['password']);
            $existsUser = $this->UserExists($validated);
            if ($existsUser) {
                return redirect()->back()->with('userExists' , 'user has been in the database');
            }
            else {
                User::create($validated);
                Log::info('User created successfully', $validated);
                return redirect()->route('users.index')->with('success', 'Add user successfully');
            }
            
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'User could not be created.'])->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info('Request to update data', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'role' => 'required|in:user,admin'
        ]);

        $validated['role'] = $validated['role'] === 'admin' ? 1 : 0;

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->back()->with('success', 'Update successful.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        //
    
        $user = User::findOrFail($id);
        $user->delete();


        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        }
}
