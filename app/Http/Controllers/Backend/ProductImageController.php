<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');

                $image = $product->images()->create([
                    'image' => 'products/' . $filename
                ]);
                $uploadedImages[] = [
                    'id' => $image->id,
                    'url' => asset('storage/' . $image->image)
                ];
            }
        }
        return response()->json([
            'success' => true,
            'images' => $uploadedImages
        ]);
    }

    public function destroy(ProductImage $image)
    {
        if (file_exists(storage_path('app/public/' . $image->image))) {
            unlink(storage_path('app/public/' . $image->image));
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');

                $img = $product->images()->create([
                    'image' => 'products/'.$filename
                ]);

                $uploadedImages[] = asset('storage/'.$img->image);
            }
        }
        return response()->json([
            'success' => true,
            'images' => $uploadedImages
        ]);
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        if (\Storage::disk('public')->exists($image->image)) {
            \Storage::disk('public')->delete($image->image);
        }
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
