<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function store(Request $request) {
        $inputFields = $request->validate([
            'title' => 'required|min:3|max:100',
            'category_id' => 'required',
            'text' => 'required',
            'file' => 'required|image'
        ]);

        if (Post::count() == 0) {
            $post_id = 1;
        } else {
            $post_id = Post::latest()->first()->id + 1;
        }

        $inputFields['link'] = Str::slug($inputFields['title'], '-') . '-' . $post_id;

        $inputFields['user_id'] = auth()->user()->id;

        $inputFields['image_path'] = 'storage/' . $request->file('file')->store('posts-images', 'public');

        $post = Post::create($inputFields);

        return response()->json([
            'message' => 'Post created successfully'
        ], 201);
    }
}
