<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users=User::where('role','user')->get();
        $posts=Post::all();
        return view('home',compact('users','posts'));
    }
}
