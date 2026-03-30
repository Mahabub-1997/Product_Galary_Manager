<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->latest()->paginate(10);
        return view('backend.layouts.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.layouts.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');

                $product->images()->create([
                    'image' => 'products/' . $filename
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Product Created Successfully!']);
    }

    public function show($id)
    {
        $product = Product::with('category', 'images')->findOrFail($id);
        return view('backend.layouts.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('backend.layouts.product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|max:255|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'nullable|boolean',
        ]);

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status'      => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        try {
            $product = Product::with('images')->findOrFail($id);
            foreach ($product->images as $img) {
                if (\Storage::disk('public')->exists($img->image)) {
                    \Storage::disk('public')->delete($img->image);
                }
            }
            $product->images()->delete();
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product and its images deleted successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error deleting product: ' . $e->getMessage()]);
        }
    }
}
