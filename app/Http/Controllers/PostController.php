<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->category) {
            return PostResource::collection(Category::where('name', $request->category)->firstOrFail()->posts()->latest()->paginate(2)->withQueryString());
        } else if ($request->search) {
            return PostResource::collection(Post::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('text', 'like', '%' . $request->search . '%')->latest()->paginate(2)->withQueryString());
        }

        return PostResource::collection(Post::latest()->paginate(2));
    }

    public function store(Request $request)
    {
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

    public function show(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            abort(403, 'You do not have permission to update this post.');
        }

        return new PostResource($post);
    }

    public function getPost(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return abort(403);
        }

        $inputFields = $request->validate([
            'title' => 'required|min:3|max:100',
            'category_id' => 'required',
            'text' => 'required',
            'file' => 'nullable|image'
        ]);

        $inputFields['link'] = Str::slug($inputFields['title'], '-') . '-' . $post->id;

        if ($request->file('file')) {
            File::delete($post->image_path);
            $inputFields['image_path'] = 'storage/' . $request->file('file')->store('posts-images', 'public');
        }

        $post->update($inputFields);

        return response()->json([
            'message' => 'Post updated successfully',
        ]);
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return abort(403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }
}
