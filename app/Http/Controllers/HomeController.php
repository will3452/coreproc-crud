<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(request()->has('q')){
            $contacts = auth()->user()->contacts()->where('name', 'LIKE', '%'.request()->q.'%')->latest()->get();
        }else {
            $contacts = auth()->user()->contacts()->latest()->get();
        }
        return view('home', compact('contacts'));
    }

   
}
