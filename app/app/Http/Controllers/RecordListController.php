<?php

namespace App\Http\Controllers;

use App\Http\Resources\FailureResponse;
use App\Http\Resources\RecordListCollection;
use App\Http\Resources\SuccessResponse;
use App\Models\RecordList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecordListController extends Controller
{
    #TODO: add swagger docs
    /**
     * @OA\Get(
     *     path="/lists",
     *     summary="Get a list of record lists",
     *     operationId="getRecordLists",
     *     tags={"RecordList"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="Number of items per page"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of record lists retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
     */
    public function index(Request $request){
        #TODO: try catch or handle in handler for http requests
        $perPage = $request->input('per_page', 15);

        return new SuccessResponse(new RecordListCollection(RecordList::paginate($perPage)),"Record Lists fetched");
    }



    /**
     * @OA\Get(
     *     path="/lists/{id}",
     *     summary="Get details of a specific record list",
     *     operationId="getRecordList",
     *     tags={"RecordList"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the record list"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record list retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record list not found",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
     */
    public function show(RecordList $recordList){
        $recordList->load('notes');
        return new SuccessResponse($recordList,"RecordList retrieved");
    }


    /**
     * @OA\Post(
     *     path="/lists",
     *     summary="Create a new record list",
     *     operationId="createRecordList",
     *     tags={"RecordList"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="list_name", type="string", description="Name of the record list")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Record list created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
     */
    public function store(Request $request){
        #REVIEW: may want to use save method, not sure about what to use
        $recordList = RecordList::create([
            'list_name' => $request->list_name,
        ]);

        return new SuccessResponse(["id"=>$recordList->id],"Record List created successfully",Response::HTTP_CREATED); 
    }


    /**
     * @OA\Put(
     *     path="/lists/{id}",
     *     summary="Update a specific record list",
     *     operationId="updateRecordList",
     *     tags={"RecordList"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the record list"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="list_name", type="string", description="Updated name of the record list")
     *         )
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Record list updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record list not found",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
     */
    public function update(Request $request, RecordList $recordList){
        $recordList->update([
            'list_name'=>$request->input('list_name','')
        ]);

        return new SuccessResponse(["note"=>$recordList],"RecordList updated successfully",Response::HTTP_ACCEPTED);
    }


    /**
     * @OA\Delete(
     *     path="/lists/{id}",
     *     summary="Delete a specific record list",
     *     operationId="deleteRecordList",
     *     tags={"RecordList"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the record list"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record list deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record list not found",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
     */
    public function destroy(RecordList $recordList){
        $recordList->delete();

        return new SuccessResponse(["id"=>$recordList->id],"RecordList deleted successfully",Response::HTTP_OK);
    }
}
