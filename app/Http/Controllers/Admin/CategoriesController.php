<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;

class CategoriesController extends Controller
{
    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('frontend.admin.categories.add-category');
    }

    /**
     * Store a newly created category in the database.
     * 
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        // Validate the request data using custom FormRequest
        $validatedData = $request->validated();

        // Attempt to create a new category
        $createdCategory = Category::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug']
        ]);

        // Check if creation failed
        if (!$createdCategory) {
            return back()->with('failed', 'Category creation has failed!');
        }

        return back()->with('success', 'Category created successfully.');
    }

    /**
     * Delete an existing category.
     * 
     * @param int $category_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($category_id)
    {
        // Find the category by ID or fail silently
        $category = Category::find($category_id);

        if (!$category) {
            return back()->with('failed', 'Category not found!');
        }

        // Delete the category
        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }

    /**
     * Show the form for editing an existing category.
     * 
     * @param int $category_id
     * @return \Illuminate\View\View
     */
    public function edit($category_id)
    {
        // Find the category or fail
        $category = Category::find($category_id);

        if (!$category) {
            return back()->with('failed', 'Category not found!');
        }

        return view('frontend.admin.categories.edit-category', compact('category'));
    }

    /**
     * Update an existing category in the database.
     * 
     * @param UpdateRequest $request
     * @param int $category_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $category_id)
    {
        // Find the category
        $category = Category::find($category_id);

        if (!$category) {
            return back()->with('failed', 'Category not found!');
        }

        // Validate the request data
        $validatedData = $request->validated();

        // Attempt to update the category
        $updated = $category->update([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug']
        ]);

        // Check if update failed
        if (!$updated) {
            return back()->with('failed', 'Category update failed!');
        }

        return back()->with('success', 'Category updated successfully.');
    }
}
