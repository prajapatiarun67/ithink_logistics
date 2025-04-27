<?php

namespace App\Http\Controllers\web;

use App\Helpers\CurlHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $appUrl = '';
    protected $data = array();

    public function __construct()
    {
        $this->appUrl = env('APP_URL').'/user-management/public/';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = "Login";
        return view('user.login', $this->data);
    }

    public function authenticate(Request $request)
    {
        $apiUrl = $this->appUrl . 'api/login'; 
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($apiUrl, [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        $this->data = $response->json();
        if (!$this->data['success']) { 
            return redirect()->back()
                ->withErrors($this->data['errors'])
                ->with('message', $this->data['message'])
                ->withInput();
        }
        // Store user details in session
        Session::put('user', $this->data['user']); // assuming API returns 'user' key with details
        return redirect()->route('dashboard')->with('success', 'Login successful');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = "Register";
        return view('user.register', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apiUrl = $this->appUrl . 'api/register'; 
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($apiUrl, [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        
        $this->data = $response->json();
        if (!$this->data['success']) { 
            return redirect()->back()
                ->withErrors($this->data['errors'])
                ->with('message', $this->data['message'])
                ->withInput();
        }
        // Store user details in session
        Session::put('user', $this->data['user']); // assuming API returns 'user' key with details
        return redirect()->route('dashboard')->with('success', 'Login successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function change_password()
    {
        $this->data['title'] = "Change Password";
        return view('user.change_password', $this->data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $apiUrl = $this->appUrl . 'api/change_password'; 
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($apiUrl, [
            'old_password' => $request->old_password,
            'email' => session('user')['email'],
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        
        $this->data = $response->json();
        if (!$this->data['success']) { 
            return redirect()->back()
                ->withErrors($this->data['errors'])
                ->with('message', $this->data['message'])
                ->withInput();
        }
        // Store user details in session
        Session::put('user', $this->data['user']); // assuming API returns 'user' key with details
        return redirect()->route('dashboard')->with('success', 'password updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout()
    {
        // Destroy the entire session
        Session::flush();
        // Optionally, you can revoke the token via API call here
        return redirect('/login')->with('message', 'You have been logged out.');
    }
}
