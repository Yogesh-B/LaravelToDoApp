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
    public function index(Request $request){
        #TODO: try catch or handle in handler for http requests
        $perPage = $request->input('per_page', 15);

        return new SuccessResponse(new RecordListCollection(RecordList::paginate($perPage)),"Record Lists fetched");
    }


    public function show(RecordList $recordList){
        $recordList->load('notes');
        return new SuccessResponse($recordList,"RecordList retrieved");
    }


    public function store(Request $request){
        #REVIEW: may want to use save method, not sure about what to use
        $recordList = RecordList::create([
            'list_name' => $request->list_name,
        ]);

        return new SuccessResponse(["id"=>$recordList->id],"Record List created successfully",Response::HTTP_CREATED); 
    }
}
