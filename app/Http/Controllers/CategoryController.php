<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $inputFields = $request->validate([
            'name' => 'required|min:3|max:50|unique:categories,name'
        ]);

        $category = Category::create($inputFields);

        return response()->json([
            'message' => 'Category created successfully'
        ], 201);
    }
}
