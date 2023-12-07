<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use App\Models\Product;
use App\Enums\Category as CategoryEnum;


class ProductController extends Controller
{
    /**
     * Display a listing of the products
     */
    public function index(Request $request)
    {
        return $request->user()->getAccessibleProducts();
    }

    
    /**
     * Store a newly created product
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => 'required|string',
            'category' => ['required', Rule::enum(CategoryEnum::class)],
            'image' => 'image',
        ])->validate();

        $category = Category::firstWhere('name', $input['category']);

        $imagePath = $request->file('image')->store('images');

        return Product::create([
            'name' => $input['name'],
            'category_id' => $category->id,
            'user_id' => $request->user()->id,
            'image' => $imagePath,
        ]);
    }
}
