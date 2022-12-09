<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return Category::with('category')->get();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    public function indexPivot()
    {
        try {
            return Category::with('categories')->where('categoryid', null)->get();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    public function indexFather()
    {
        try {
            return Category::where('categoryid', null)->get();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoryRequest $request)
    {
        try {
            $data = $request->all();

            $category = Category::create($data);
            return response()->json([
                'message' => 'Categoria Adicionada Com Sucesso!',
                'data' => $category,
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::with('categories', 'category')->find($id);
            return response()->json($category);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    public function targets($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category->targets);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(categoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->update($request->all());
            return response()->json([
                'message' => 'Categoria Atualizada Com Sucesso!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();

            return response()->json([
                'message' => 'Categoria Deletada Com Sucesso!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }
}
