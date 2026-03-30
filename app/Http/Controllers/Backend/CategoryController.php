<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('backend.layouts.category.index', compact('categories'));
    }


    public function create()
    {
        return view('backend.layouts.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:categories|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            $category = new Category();
            $category->name        = $request->name;
            $category->slug        = Str::slug($request->name);
            $category->description = $request->description;
            $category->status      = $request->has('status') ? 1 : 0;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('categories', $filename, 'public');
                $category->image = 'categories/' . $filename;
            }
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category Created Successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Database Error: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Category $category)
    {
        return view('backend.layouts.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|max:255|unique:categories,name,' . $id,
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->name        = $request->name;
            $category->slug        = Str::slug($request->name);
            $category->description = $request->description;
            $category->status      = $request->has('status') ? 1 : 0;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                if ($category->image && \Storage::disk('public')->exists($category->image)) {
                    \Storage::disk('public')->delete($category->image);
                }
                $file->storeAs('categories', $filename, 'public');
                $category->image = 'categories/' . $filename;
            }
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category Updated Successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Database Error: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->image && \Storage::disk('public')->exists($category->image)) {
                \Storage::disk('public')->delete($category->image);
            }
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error deleting category: ' . $e->getMessage()]);
        }
    }
}
