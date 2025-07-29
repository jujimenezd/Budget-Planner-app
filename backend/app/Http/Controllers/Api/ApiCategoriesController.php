<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ApiCategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $data = $request->only(['name', 'type']);
        $data['type'] = $data['type'] == '1' ? 'income' : 'expense';
        Category::create($data);
        return response()->json(['message' => 'Categoría creada correctamente'], 201);
    }


    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }
        return response()->json($category, 200);
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->type = $request->type;
        $category->save();
        return response()->json($category, 200);
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['message' => 'Categoría eliminada correctamente'], 204);
    }
}