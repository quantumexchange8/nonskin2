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
        $products = Product::selectRaw('*, CASE WHEN discount > 0 THEN (price - (price * discount / 100)) ELSE price END as selling_price')
            ->latest()
            ->where('status', 'Active')
            ->get();
        // dd($products);
        return view('web.products.index', compact('products'));
    }


    public function list()
    {
        $products = Product::with('category')->get();
        return view('admin.products.list', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::where('status', 'Active')->pluck('name_en', 'id');
        // dd($categories);
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        // dd($request);
        $request->validate([
            'code'              => 'required',
            'name_en'           => 'required',
            'name_cn'           => 'required',
            'desc_en'           => 'required',
            'desc_cn'           => 'required',
            'price'             => 'required',
            'discount'          => 'nullable|numeric',
            'category_id'       => 'required',
            'shipping_quantity' => 'required',
            'status'            => 'required',
            'image_1'           => 'required|image|max:2048',
            'image_2'           => 'nullable|image|max:2048',
            'image_3'           => 'nullable|image|max:2048',
            'image_4'           => 'nullable|image|max:2048',
            'image_5'           => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('image_1')){
                $imageName1 = time().'.'.$request->image_1->extension();
                $request->image_1->move(public_path('images/products'), $imageName1);
            }
            if ($request->hasFile('image_2')){
                $imageName2 = time().'.'.$request->image_2->extension();
                $request->image_2->move(public_path('images/products'), $imageName2);
            }
            if ($request->hasFile('image_3')){
                $imageName3 = time().'.'.$request->image_3->extension();
                $request->image_3->move(public_path('images/products'), $imageName3);
            }
            if ($request->hasFile('image_4')){
                $imageName4 = time().'.'.$request->image_4->extension();
                $request->image_4->move(public_path('images/products'), $imageName4);
            }
            if ($request->hasFile('image_5')){
                $imageName5 = time().'.'.$request->image_5->extension();
                $request->image_5->move(public_path('images/products'), $imageName5);
            }

            $product = Product::create([
                'code' => $request->code,
                'name_en' => $request->name_en,
                'name_cn' => $request->name_cn,
                'desc_en' => $request->desc_en,
                'desc_cn' => $request->desc_cn,
                'price' => $request->price,
                'discount' => $request->discount,
                'category_id' => $request->category_id,
                'shipping_quantity' => $request->shipping_quantity,
                'status' => $request->status,
                'image_1' => $imageName1,
                'image_2' => $imageName2 ?? null,
                'image_3' => $imageName3 ?? null,
                'image_4' => $imageName4 ?? null,
                'image_5' => $imageName5 ?? null,
                'created_by' => Auth::id(),
                'updated_at' => null
            ]);

            // Upload and store the images
            if ($request->hasFile('image_1')) {
                $image1 = $request->file('image_1');
                // $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
                // $image1->storeAs('images/products', $imageName1, 'public');
                $product->image_1 = $imageName1;
            }

            if ($request->hasFile('image_2')) {
                $image2 = $request->file('image_2');
                // $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
                // $image2->storeAs('images', $imageName2, 'public');
                $product->image_2 = $imageName2;
            }

            if ($request->hasFile('image_3')) {
                $image3 = $request->file('image_3');
                // $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
                // $image3->storeAs('images', $imageName3, 'public');
                $product->image_3 = $imageName3;
            }

            if ($request->hasFile('image_4')) {
                $image4 = $request->file('image_4');
                // $imageName4 = time() . '.' . $image4->getClientOriginalExtension();
                // $image4->storeAs('images', $imageName4, 'public');
                $product->image_4 = $imageName4;
            }

            if ($request->hasFile('image_5')) {
                $image5 = $request->file('image_5');
                // $imageName5 = time() . '.' . $image5->getClientOriginalExtension();
                // $image5->storeAs('images', $imageName5, 'public');
                $product->image_5 = $imageName5;
            }
            $product->save();

            return redirect()
                ->route('admin.products.list')
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
        $categories = Category::where('status', 'Active')->pluck('name_en', 'id');
        $statuses = ['Active', 'Inactive'];
        $quantities = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        return view('admin.products.edit', compact('product', 'categories', 'statuses', 'quantities'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required',
            'name_en' => 'required',
            'name_cn' => 'required',
            'desc_en' => 'required',
            'desc_cn' => 'required',
            'price' => 'required',
            'discount' => 'nullable|numeric',
            'category_id' => 'required',
            'shipping_quantity' => 'required',
            'status' => 'required',
            'image_1' => 'nullable|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
            'image_3' => 'nullable|image|max:2048',
            'image_4' => 'nullable|image|max:2048',
            'image_5' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('image_1')){
                $imageName1 = time().'.'.$request->image_1->extension();
            $request->image_1->move(public_path('images/products'), $imageName1);
            }
            if ($request->hasFile('image_2')){
                $imageName2 = time().'.'.$request->image_2->extension();
                $request->image_2->move(public_path('images/products'), $imageName2);
            }
            if ($request->hasFile('image_3')){
                $imageName3 = time().'.'.$request->image_3->extension();
            $request->image_3->move(public_path('images/products'), $imageName3);
            }
            if ($request->hasFile('image_4')){
                $imageName4 = time().'.'.$request->image_4->extension();
            $request->image_4->move(public_path('images/products'), $imageName4);
            }
            if ($request->hasFile('image_5')){
                $imageName5 = time().'.'.$request->image_5->extension();
            $request->image_5->move(public_path('images/products'), $imageName5);
            }

            $product->update([
                'code' => $request->code,
                'name_en' => $request->name_en,
                'name_cn' => $request->name_cn,
                'desc_en' => $request->desc_en,
                'desc_cn' => $request->desc_cn,
                'price' => $request->price,
                'discount' => $request->discount,
                'category_id' => $request->category_id,
                'shipping_quantity' => $request->shipping_quantity,
                'status' => $request->status,
                'updated_by' => Auth::id(),
                'updated_at' => now()
            ]);

            // Upload and store the images
            if ($request->hasFile('image_1')) {
                $image1 = $request->file('image_1');
                // $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
                // $image1->storeAs('images/products', $imageName1, 'public');
                $product->image_1 = $imageName1;
            }

            if ($request->hasFile('image_2')) {
                $image2 = $request->file('image_2');
                // $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
                // $image2->storeAs('images', $imageName2, 'public');
                $product->image_2 = $imageName2;
            }

            if ($request->hasFile('image_3')) {
                $image3 = $request->file('image_3');
                // $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
                // $image3->storeAs('images', $imageName3, 'public');
                $product->image_3 = $imageName3;
            }

            if ($request->hasFile('image_4')) {
                $image4 = $request->file('image_4');
                // $imageName4 = time() . '.' . $image4->getClientOriginalExtension();
                // $image4->storeAs('images', $imageName4, 'public');
                $product->image_4 = $imageName4;
            }

            if ($request->hasFile('image_5')) {
                $image5 = $request->file('image_5');
                // $imageName5 = time() . '.' . $image5->getClientOriginalExtension();
                // $image5->storeAs('images', $imageName5, 'public');
                $product->image_5 = $imageName5;
            }
            $product->save();

            return redirect()
                ->route('admin.products.edit', [$product->id])
                ->with("updated", "Product successfully updated!");
        } catch (\Exception $e) {
            // Handle the exception here, for example:
            return redirect()
                ->back()
                ->with("error", "An error occurred: " . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        //
    }
}
