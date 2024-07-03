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
    
            return new SuccessResponse(new NoteCollection(Note::paginate($perPage)),"Notes fetched");
        }
    
    
        public function show(Note $note){
            return new SuccessResponse($note,"Note retrieved");
        }
    
    
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


        public function update(Request $request, Note $note){
            $note->update([
                'title'=>$request->input('title',""),
                'description'=>$request->input('description'),
                'is_completed'=>$request->input('is_completed',false),
            ]);

            return new SuccessResponse(["note"=>$note],"Note updated successfully",Response::HTTP_ACCEPTED);
        }


        public function destroy(Note $note){
            $note->delete();

            return new SuccessResponse(["id"=>$note->id],"Note deleted successfully",Response::HTTP_OK);
        }

}
