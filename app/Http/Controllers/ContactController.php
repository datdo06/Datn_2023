<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
    public function term()
    {
        return view('term');
    }
}

