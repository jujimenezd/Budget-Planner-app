<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {
        $categories = Category::with('user')->get();
        return view('categories.categories')->with('categories', $categories);
    }

    
    public function create()
    {
        $users = User::all(); // Para seleccionar el usuario que crea la categoria
        return view('categories.create', compact('users'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $data = $request ->only(['name', 'type']);
        $data['type'] = $data['type'] == '1' ? 'income':'expense';

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
    }

    
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    
    public function edit(Category $category)
    {
        $users = User::all();
        return view('categories.edit_categories', compact('category', 'users'));
    }

    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
    }
}