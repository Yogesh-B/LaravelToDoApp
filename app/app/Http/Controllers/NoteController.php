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
        public function index(Request $request){
            $perPage = $request->input('per_page', 15);
    
            return new SuccessResponse( NoteCollection(Note::paginate($perPage)),"Notes fetched");
        }
    
    
        public function show(Note $note){
            return new SuccessResponse($note,"Note retrieved");
        }
    
    
        public function store(RecordList $recordList, Request $request){

            $listId = $recordList->id;

            $recordList = Note::create([
                'list_id'=> $listId,
                'description'=>$request->input('description',""),
                'is_completed'=>$request->input('is_completed',false),
            ]);
    
            return new SuccessResponse(["id"=>$recordList->id],"Record List created successfully",Response::HTTP_CREATED);
        }
}
