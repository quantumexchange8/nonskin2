<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::selectRaw('*, CASE WHEN discount > 0 THEN (price - (price * discount / 100)) ELSE price END as selling_price')
            ->where('status', 'Active')
            ->whereHas('category', function ($query) {
                $query->where('status', 'Active');
            })
            ->with(['category' => function ($query) {
                $query->where('status', 'Active');
            }])
            ->get();

        // dd($products);
        return view('web.products.index', compact('products'));
    }


    public function listing(){
        $products = Product::with('category')->get();
        return view('web.products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::where('status', 'Active')->pluck('name_en', 'id');
        // dd($categories);
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'code'              => 'required',
            'name'           => 'required',
            'description'           => 'required',
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
            // if ($request->hasFile('image_1')){
            //     $imageName1 = time().'.'.$request->image_1->extension();
            //     $request->image_1->move(public_path('images/products'), $imageName1);
            // }
            // if ($request->hasFile('image_2')){
            //     $imageName2 = time().'.'.$request->image_2->extension();
            //     $request->image_2->move(public_path('images/products'), $imageName2);
            // }
            // if ($request->hasFile('image_3')){
            //     $imageName3 = time().'.'.$request->image_3->extension();
            //     $request->image_3->move(public_path('images/products'), $imageName3);
            // }
            // if ($request->hasFile('image_4')){
            //     $imageName4 = time().'.'.$request->image_4->extension();
            //     $request->image_4->move(public_path('images/products'), $imageName4);
            // }
            // if ($request->hasFile('image_5')){
            //     $imageName5 = time().'.'.$request->image_5->extension();
            //     $request->image_5->move(public_path('images/products'), $imageName5);
            // }

            $imageNames = [];

            for ($i = 1; $i <= 5; $i++) {
                $inputName = "image_" . $i;

                if ($request->hasFile($inputName)) {
                    $imageName = time() . '_' . $i . '.' . $request->$inputName->extension();
                    $request->$inputName->move(public_path('images/products'), $imageName);
                    $imageNames[$inputName] = $imageName;
                }
            }

            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => 0,
                'category_id' => $request->category_id,
                'shipping_quantity' => $request->shipping_quantity,
                'status' => $request->status,
                'image_1' => $imageNames['image_1'],
                'image_2' => $imageNames['image_2'] ?? null,
                'image_3' => $imageNames['image_3'] ?? null,
                'image_4' => $imageNames['image_4'] ?? null,
                'image_5' => $imageNames['image_5'] ?? null,
                // uncomment images below if necessary
                // 'image_6' => $imageNames['image_6'] ?? null,
                // 'image_7' => $imageNames['image_7'] ?? null,
                // 'image_8' => $imageNames['image_8'] ?? null,
                // 'image_9' => $imageNames['image_9'] ?? null,
            ]);

            // Upload and store the images
            // if ($request->hasFile('image_1')) {
            //     $image1 = $request->file('image_1');
            //     // $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
            //     // $image1->storeAs('images/products', $imageName1, 'public');
            //     $product->image_1 = $imageName1;
            // }

            // if ($request->hasFile('image_2')) {
            //     $image2 = $request->file('image_2');
            //     // $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
            //     // $image2->storeAs('images', $imageName2, 'public');
            //     $product->image_2 = $imageName2;
            // }

            // if ($request->hasFile('image_3')) {
            //     $image3 = $request->file('image_3');
            //     // $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
            //     // $image3->storeAs('images', $imageName3, 'public');
            //     $product->image_3 = $imageName3;
            // }

            // if ($request->hasFile('image_4')) {
            //     $image4 = $request->file('image_4');
            //     // $imageName4 = time() . '.' . $image4->getClientOriginalExtension();
            //     // $image4->storeAs('images', $imageName4, 'public');
            //     $product->image_4 = $imageName4;
            // }

            // if ($request->hasFile('image_5')) {
            //     $image5 = $request->file('image_5');
            //     // $imageName5 = time() . '.' . $image5->getClientOriginalExtension();
            //     // $image5->storeAs('images', $imageName5, 'public');
            //     $product->image_5 = $imageName5;
            // }
            // $product->save();

            return redirect()
                ->route('list')
                ->with("created", "Product successfully created!");
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
        return view('admin.products.show', compact('product'));
    }

    public function showdetails(Product $product)
    {
        // dd($product->image_1);
        return view('member.products.product_details', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', 'Active')->pluck('name_en', 'id');
        $statuses = ['Active', 'Inactive'];
        $quantities = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $title = 'Remove Picture!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.products.edit', compact('product', 'categories', 'statuses', 'quantities'));
    }

    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
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
            // if ($request->hasFile('image_1')){
            //     $imageName1 = time().'.'.$request->image_1->extension();
            // $request->image_1->move(public_path('images/products'), $imageName1);
            // }
            // if ($request->hasFile('image_2')){
            //     $imageName2 = time().'.'.$request->image_2->extension();
            //     $request->image_2->move(public_path('images/products'), $imageName2);
            // }
            // if ($request->hasFile('image_3')){
            //     $imageName3 = time().'.'.$request->image_3->extension();
            // $request->image_3->move(public_path('images/products'), $imageName3);
            // }
            // if ($request->hasFile('image_4')){
            //     $imageName4 = time().'.'.$request->image_4->extension();
            // $request->image_4->move(public_path('images/products'), $imageName4);
            // }
            // if ($request->hasFile('image_5')){
            //     $imageName5 = time().'.'.$request->image_5->extension();
            // $request->image_5->move(public_path('images/products'), $imageName5);
            // }

            $imageNames = [];

            for ($i = 1; $i <= 5; $i++) {
                $inputName = "image_" . $i;

                if ($request->hasFile($inputName)) {
                    $imageName = time() . '_' . $i . '.' . $request->$inputName->extension();
                    $request->$inputName->move(public_path('images/products'), $imageName);
                    $imageNames[$inputName] = $imageName;
                }
            }
            // dd('here');

            $product->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => 0,
                'category_id' => $request->category_id,
                'shipping_quantity' => $request->shipping_quantity,
                'status' => $request->status,
                'image_1' => $product->image_1 ?? $imageNames['image_1'] ?? null,
                'image_2' => $product->image_2 ?? $imageNames['image_2'] ?? null,
                'image_3' => $product->image_3 ?? $imageNames['image_3'] ?? null,
                'image_4' => $product->image_4 ?? $imageNames['image_4'] ?? null,
                'image_5' => $product->image_5 ?? $imageNames['image_5'] ?? null,
                // 'updated_by' => Auth::id(),
                // 'updated_at' => now()
            ]);

            // Upload and store the images
            // if ($request->hasFile('image_1')) {
            //     $image1 = $request->file('image_1');
            //     // $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
            //     // $image1->storeAs('images/products', $imageName1, 'public');
            //     $product->image_1 = $imageName1;
            // }

            // if ($request->hasFile('image_2')) {
            //     $image2 = $request->file('image_2');
            //     // $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
            //     // $image2->storeAs('images', $imageName2, 'public');
            //     $product->image_2 = $imageName2;
            // }

            // if ($request->hasFile('image_3')) {
            //     $image3 = $request->file('image_3');
            //     // $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
            //     // $image3->storeAs('images', $imageName3, 'public');
            //     $product->image_3 = $imageName3;
            // }

            // if ($request->hasFile('image_4')) {
            //     $image4 = $request->file('image_4');
            //     // $imageName4 = time() . '.' . $image4->getClientOriginalExtension();
            //     // $image4->storeAs('images', $imageName4, 'public');
            //     $product->image_4 = $imageName4;
            // }

            // if ($request->hasFile('image_5')) {
            //     $image5 = $request->file('image_5');
            //     // $imageName5 = time() . '.' . $image5->getClientOriginalExtension();
            //     // $image5->storeAs('images', $imageName5, 'public');
            //     $product->image_5 = $imageName5;
            // }
            // $product->save();

            return redirect()
                ->route('list')
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

    public function removePicture(Product $product, $imageNumber){
        try {
            $imageColumn = "image_" . $imageNumber;

            if ($product->$imageColumn) {
                // Delete the image file from the server
                $imagePath = public_path('images/products/' . $product->$imageColumn);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Update the database column to null
                $product->$imageColumn = null;
                $product->update();
            } else {
                return redirect()->back()->with('error', "Please upload a picture before trying to remove it!");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Something went wrong!");
        }

        return redirect()->back()->with('updated', "Product's picture has been removed successfully");
    }

    public function productlist ()
    {
        $products = Product::selectRaw('*, CASE WHEN discount > 0 THEN (price - (price * discount / 100)) ELSE price END as selling_price')
            ->where('status', 'Active')
            ->whereHas('category', function ($query) {
                $query->where('status', 'Active');
            })
            ->with('category')
            ->get();
        // dd($products);
        return view('member.products.product_list', compact('products'));
    }
}
