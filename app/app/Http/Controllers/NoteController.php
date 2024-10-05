<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteCollection;
use App\Http\Resources\SuccessResponse;
use App\Models\Note;
use App\Models\RecordList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/notes",
     *     summary="Get all notes",
     *     description="Fetches a paginated list of notes.",
     *     tags={"Notes"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of notes per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Notes fetched successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to fetch notes",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
    */
    public function index(Request $request){
        $perPage = $request->input('per_page', 15);

        return new SuccessResponse(new NoteCollection(Note::paginate($perPage)),"Notes fetched");
    }
    
    /**
     * @OA\Get(
     *     path="/notes/{id}",
     *     summary="Get a specific note",
     *     description="Fetches a specific note by its ID.",
     *     tags={"Notes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the note to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Note retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Note not found",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
    */
    public function show(Note $note){
        return new SuccessResponse($note,"Note retrieved");
    }
    
    
    /**
     * @OA\Post(
     *     path="/lists/{record_list_id}/notes",
     *     summary="Create a new note",
     *     description="Creates a new note under a specific record list.",
     *     tags={"Notes"},
     *     @OA\Parameter(
     *         name="record_list_id",
     *         in="path",
     *         description="ID of the record list",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="New Note"),
     *             @OA\Property(property="description", type="string", example="This is a note."),
     *             @OA\Property(property="is_completed", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Note created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to create note",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
    */
    public function store(RecordList $recordList, Request $request){

        $listId = $recordList->id;

        $recordList = Note::create([
            'list_id'=> $listId,
            'title'=>$request->input('title',""),
            'description'=>$request->input('description'),
            'is_completed'=>$request->input('is_completed',false),
        ]);

        return new SuccessResponse(["id"=>$recordList->id],"Note created successfully",Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *     path="/notes/{id}",
     *     summary="Update a note",
     *     description="Updates the details of a specific note.",
     *     tags={"Notes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the note to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Note"),
     *             @OA\Property(property="description", type="string", example="Updated description."),
     *             @OA\Property(property="is_completed", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Note updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to update note",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
    */
    public function update(Request $request, Note $note){
        $note->update([
            'title'=>$request->input('title',""),
            'description'=>$request->input('description'),
            'is_completed'=>$request->input('is_completed',false),
        ]);

        return new SuccessResponse(["note"=>$note],"Note updated successfully",Response::HTTP_ACCEPTED);
    }


        /**
     * @OA\Delete(
     *     path="/notes/{id}",
     *     summary="Delete a note",
     *     description="Deletes a specific note.",
     *     tags={"Notes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the note to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Note deleted successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Note not found",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to delete note",
     *         @OA\JsonContent(ref="#/components/schemas/FailureResponse")
     *     )
     * )
    */
    public function destroy(Note $note){
        $note->delete();

        return new SuccessResponse(["id"=>$note->id],"Note deleted successfully",Response::HTTP_OK);
    }

}
