<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        echo "hello";
        if (session()->has('user')) {
            // Session key 'user' exists
            $user = session('user');
        } else {
            // Not logged in or session expired
            return redirect()->route('login')->with('message', 'Please log in first.');
        }
    }
}
