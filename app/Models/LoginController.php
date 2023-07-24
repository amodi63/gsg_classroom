<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Model
{
    use HasFactory;
    public function create() {
        return view('auth.login');
    }
    public function store(Request $request) {
        $request->validate([
            'email' => ['requeired'],
            'password' => ['requeired']
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $result  = Auth::attempt($credentials,$request->boolean('remember'));
        // $user = User::where('email', $request->email)->first();
        // if($user && Hash::check($request->password, $user->password)) {
        //     Auth::login($user, $request->boolean('remember'));
        //     return redirect()->route('classrooms.index');

        // }
        if($result) {
            return redirect()->intended('/');

        }
        return back()->withInput()->withErrors([
            'email' => 'Invalid credentials!'
        ]);

    }
}
