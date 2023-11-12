<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartitionRequest;
use App\Http\Requests\UpdatePartitionRequest;
use App\Models\Partition;
use Illuminate\Http\Request;
use App\Http\Resources\PartitionResource;

class PartitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $partitions = Partition::get();

            if ($partitions) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Partitions Retrieved Successfully',
                    'data' => PartitionResource::collection($partitions)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Partitions are not found',
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
    public function store(PartitionRequest $request)
    {
        try {
            $partition = Partition::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'cat_id' => $request->cat_id

            ]);

            if ($partition) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Partition Created Successfully',
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
            $partition = Partition::find($id);

            if ($partition) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Partition Retrieved Successfully',
                    'data' => new PartitionResource($partition)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Partition is not found',
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
    public function update(UpdatePartitionRequest $request, string $id)
    {
        try {
            $partition = Partition::find($id);

            $part = false;
            if($partition){
                $part = $partition->update($request->all());
            }

            if ($part) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Partition Updated Successfully',
                    'data' => new PartitionResource($partition)
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Partition is not found',
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
            $partition = Partition::find($id);

            if ($partition) {
                $partition->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Partition deleted Successfully',
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Partition is not found',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
