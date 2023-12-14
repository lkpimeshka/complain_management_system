<?php

namespace App\Http\Controllers;
use App\Mail\SendMail;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function sendMail()
    {
        $details = [
            'name' => 'test',
            'email' => 'test',
        ];

        \Mail::to('pasanimeshka95@gmail.com')->send(new SendMail($details));
        return view('mail.ContactMail', ['data' => $details]);
    }
}
