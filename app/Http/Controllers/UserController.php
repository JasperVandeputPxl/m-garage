<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        return view('users.index', [ 'users' => User::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6']
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_type' => 'user'
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Account created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        return view('users.edit', [ 'user' => $user ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6']
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User \'' . $user->name . '\' was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        if (Auth::user()->id == $user->id) {
            return redirect()
                ->route('users.index')
                ->withErrors('You cannot delete yourself!');
        };

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User \'' . $user->name . '\' was successfully deleted!');
    }

    public function promote(Request $request, User $user) {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        $request->validate([ 'promote' => ['required', 'boolean'] ]);

        $user->user_type = $request->input('promote') ? 'admin' : 'user';
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User \'' . $user->name . '\' was successfully ' . ($request->input('promote') ? 'promoted' : 'demote') . ' to ' . ($request->input('promote') ? 'admin' : 'user') . '!');
    }
}
