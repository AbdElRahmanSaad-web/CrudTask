<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cats = Category::get();
    
            if ($cats->isNotEmpty()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Categories Retrieved Successfully',
                    'data' => CategoryResource::collection($cats)
                ]);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'Categories are not found',
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $cat = Category::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar
            ]);
    
            if ($cat) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category Created Successfully',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cat = Category::find($id);

            if ($cat) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category Retrieved Successfully',
                    'data' => new CategoryResource($cat)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Category is not found',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $cat = Category::find($id);

            $category = false;
            if($cat){
                $category = $cat->update($request->all());
            }

            if ($category) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category Updated Successfully',
                    'data' => new CategoryResource($cat)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Category is not found',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cat = Category::find($id);

            if ($cat) {
                $cat->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Category deleted Successfully',
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Category is not found',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
