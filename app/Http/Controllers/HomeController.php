<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::latest()->take(6)->get());
    }
}
