<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
public function login(Request $request)
{
    $user = User::where('email', $request->input('email'))->first();

    if ($user) {
        if (Hash::check($request->input('password'), $user->password)) {
            auth()->login($user);

                    // 🔥 Fire login event manually
        event(new Login('web', $user, false));

            if (auth()->user()->role == 'patient') {
                return redirect()->to('/patienthome');
            } else if (auth()->user()->role == 'doctor') {
                return redirect()->to('/doctorhome');
            } else if (auth()->user()->role == 'admin') {
                return redirect()->to('/adminhome');
            } else if (auth()->user()->role == 'staff') {
                return redirect()->to('/staffhome');
            } else {
                return redirect()->to('/')->with('error', 'Peranan pengguna tidak sah.');
            }
        } else {
               event(new Failed('web', $user, [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]));
            return redirect()->back()->with('error', 'Emel atau kata laluan tidak sah, sila cuba lagi!');
        }
    } else {
          event(new Failed('web', $user, [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]));
        return redirect()->back()->with('error', 'Emel atau kata laluan tidak sah, sila cuba lagi!');
    }
}


public function signout()
{
     $user = User::where('id',auth()->user()->id)->first();

    event(new Logout('web', $user));

    auth()->logout();
    return redirect('/');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
