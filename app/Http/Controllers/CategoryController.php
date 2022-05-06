<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
  
    public function index(Request $request)
    {
        $request->all();

        $categories = Category::select();

        if ($request['categoryId']) {
            $categories = $categories->where('id', $request['categoryId']);
        }

        if ($request['categoryName']) {
            $categories = $categories->where('name', 'like', '%' . $request['categoryName'] . '%');
        }

        if ($request['orderByFieldName']) {
            $categories = $categories->orderBy($request['orderByFieldName'], $request['orderByMethod']);
        }

        return response()->json(compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:250|min:4', 
            'description' => 'nullable|max:1000|min:4', 
            'icon' => 'nullable|max:250|min:4', 
            'image' => 'nullabe|mimes:.jpg,.jpeg,.png,.bmp'
        ]);

        Category::create($request->only([
            'name',
            'description',
            'icon',
            'image',
        ]));

        return response()->json(['message' => 'Deu tudo boa'], Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:250|min:4', 
            'description' => 'nullable|max:1000|min:4', 
            'icon' => 'nullable|max:250|min:4', 
            'image' => 'nullabe|mimes:.jpg,.jpeg,.png,.bmp'
        ]);

        $categoryId = $request->post('id');
        Category::where('id', $categoryId)->update($request);

        return response()->json(['message' => 'Deu tudo boa'], Response::HTTP_OK);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|int|min:1'
        ]);

        $categoryId = $request->post('id');
        Category::where('id', $categoryId)->delete();

        return response()->json(['message' => 'Requisição Completada com Sucesso'], Response::HTTP_OK);
    }
}
