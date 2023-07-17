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
        $products = Product::latest()->where('status', 'Active')->get();
        return view('member.product_list', compact('products'));
    }

    public function list()
    {
        $products = Product::all();
        return view('admin.products.list', ['products' => $products]);
    }

    public function create()
    {
        return view('web.admin.products.create');
    }

    public function store(Request $request) {
        // dd($request);
        $request->validate([
            // Validation rules for other fields

            'image_1' => 'required|image|max:2048', // Ensure it's an image file with a maximum size of 2MB
            'image_2' => 'nullable|image|max:2048',
            'image_3' => 'nullable|image|max:2048',
            'image_4' => 'nullable|image|max:2048',
            'image_5' => 'nullable|image|max:2048',
            // Add validation rules for other image fields
        ]);

        $imageName1 = time().'.'.$request->image_1->extension();

        try {
            $product = Product::create([
                'code' => $request->code,
                'name_en' => $request->name_en,
                'name_cn' => $request->name_cn,
                'desc_en' => $request->desc_en,
                'desc_cn' => $request->desc_cn,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'shipping_quantity' => $request->shipping_quantity,
                'status' => $request->status,
                'image_1' => $request->image_1->move(public_path('images'), $imageName1),
                'created_by' => Auth::id(),
            ]);

                    // Upload and store the images
            // if ($request->hasFile('image_1')) {
            //     $image1 = $request->file('image_1');
            //     $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
            //     $image1->storeAs('images', $imageName1, 'public');
            //     $product->image_1 = $imageName1;
            // }

            // if ($request->hasFile('image_2')) {
            //     $image2 = $request->file('image_2');
            //     $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
            //     $image2->storeAs('images', $imageName2, 'public');
            //     $product->image_2 = $imageName2;
            // }

            // if ($request->hasFile('image_3')) {
            //     $image3 = $request->file('image_3');
            //     $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
            //     $image3->storeAs('images', $imageName3, 'public');
            //     $product->image_3 = $imageName3;
            // }

            // if ($request->hasFile('image_4')) {
            //     $image4 = $request->file('image_4');
            //     $imageName4 = time() . '.' . $image4->getClientOriginalExtension();
            //     $image4->storeAs('images', $imageName4, 'public');
            //     $product->image_4 = $imageName4;
            // }

            // if ($request->hasFile('image_5')) {
            //     $image5 = $request->file('image_5');
            //     $imageName5 = time() . '.' . $image5->getClientOriginalExtension();
            //     $image5->storeAs('images', $imageName5, 'public');
            //     $product->image_5 = $imageName5;
            // }

            $product->save();

            return redirect()
                ->route('products.list')
                ->with("added", "Product successfully created!");
        } catch (\Exception $e) {
            // Handle the exception here, for example:
            return redirect()
                ->back()
                ->with("error", "An error occurred: " . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        // dd($product->image_1);
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
