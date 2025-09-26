<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::withCount('menuItems')->orderBy('sort_order')->get();
        return view('menu-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('menu-categories.create');
    }

    public function edit(MenuCategory $menuCategory)
    {
        return view('menu-categories.edit', compact('menuCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:menu_categories',
            'sort_order' => 'nullable|integer',
           
        ]);

        MenuCategory::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active')
        ]);

        return redirect()->route('menu-categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, MenuCategory $menuCategory)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('menu_categories')->ignore($menuCategory->id)],
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $menuCategory->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active')
        ]);

        return redirect()->route('menu-categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy(MenuCategory $menuCategory)
    {
        if ($menuCategory->menuItems()->count() > 0) {
            return redirect()->route('menu-categories.index')->with('error', 'Cannot delete category with menu items.');
        }

        $menuCategory->delete();
        return redirect()->route('menu-categories.index')->with('success', 'Category deleted successfully.');
    }
}
