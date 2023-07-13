<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::latest()->get();
        return view('web.products.index', compact('products'));
    }

    public function list()
    {
        $products = Product::latest()->get();
        return view('web.admin.products.list');
    }

    public function create()
    {
        return view('web.admin.products.create');
    }

    public function store(Request $request) {
        // try {
            Product::create(
                [
                    'code' => $request->code,
                    'name_en' => $request->name_en,
                    'name_cn' => $request->name_cn,
                    'desc_en' => $request->desc_en,
                    'desc_cn' => $request->desc_cn,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                    'shipping_quantity' => $request->shipping_quantity,
                    'image_1' => $request->image_1,
                    'image_2' => $request->image_2,
                    'image_3' => $request->image_3,
                    'image_4' => $request->image_4,
                    'image_5' => $request->image_5,
                    'status' => $request->status,
                    'created_by' => Auth::id(),
                ]
            );
            return redirect()
                ->route('products.list')
                ->with("added", "Product successfully created!");
        // } catch (\Exception $e) {
            // Handle the exception here, for example:
            return redirect()
                ->back()
                ->with("error", "An error occurred: " . $e->getMessage());
        // }

    }

    public function show(Product $product)
    {
        $products = Product::with('category')->get();
        return view('web.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
