<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $items = Item::get();

            if ($items) {
                return response()->json([
                    'status' => 200,
                    'message' => 'items Retrieved Successfully',
                    'data' => ItemResource::collection($items)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'items are not found',
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
    public function store(ItemRequest $request)
    {
        try {
            $item = Item::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'partition_id' => $request->partition_id,
                'cat_id' => $request->cat_id
            ]);

            if ($item) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Item Created Successfully',
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
            $item = Item::find($id);

            if ($item) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Item Retrieved Successfully',
                    'data' => new ItemResource($item)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Item is not found',
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
    public function update(UpdateItemRequest $request, string $id)
    {
        try {
            $item = Item::find($id);
            $itm = false;
            if($item){
                $itm = $item->update($request->all());
            }

            if ($itm) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Item Updated Successfully',
                    'data' => new ItemResource($item)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Item is not found',
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
            $item = Item::find($id);

            if ($item) {
                $item->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Item deleted Successfully',
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Item is not found',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
