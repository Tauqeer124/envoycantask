<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();
        
            // Store the image name with extension in the database
            $user->image = $imageName;
            
        
            // Move the uploaded file to a desired location
            $image->move('public', $imageName);
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();
        
            // Delete the previous image if it exists
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
        
            // Store the new image name with extension in the database
            $user->image = $imageName;
           
        
            // Move the uploaded file to the desired location
            $image->move('public/', $imageName);
        }
        dd
        
        $user->save();
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
