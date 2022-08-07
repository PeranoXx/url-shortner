<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class stateController extends Controller
{
    public function index()
    {
        
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            return view('states', compact('user', $user));
        } else {
            return redirect('login');
        }
    }
}
