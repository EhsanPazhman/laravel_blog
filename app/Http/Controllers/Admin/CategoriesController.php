<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;

class CategoriesController extends Controller
{
    public function add()
    {
        return view('frontend.admin.categories.add-category');
    }
    public function store(StoreRequest $request)
    {
        $valdatedData = $request->validated();
        $createdCategory = Category::create([
            'name' => $valdatedData['name'],
            'slug' => $valdatedData['slug']
        ]);
        if (!$createdCategory) {
            return back()->with('failed', 'Category creat hasbeen failed!');
        }
        return back()->with('success', 'Ctegory created successfully');
    }
    public function delete($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        return back()->with('success', 'Category deleted!');
    }
    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('frontend.admin.categories.edit-category', compact('category'));
    }
    public function update(UpdateRequest $request,$category_id)
    {
        $category = Category::find($category_id);
        $valdatedData = $request->validated();
        $category->update(
            [
                'name' => $valdatedData['name'],
                'slug' => $valdatedData['slug']
            ]
        );
        if (!$category) {
            return back()->with('failed', 'Category does not updated!');
        }
        return back()->with('success', 'Category has been updated.');
    }
}
