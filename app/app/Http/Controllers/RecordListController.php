<?php

namespace App\Http\Controllers;

use App\Http\Resources\FailureResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\RecordList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecordListController extends Controller
{
    #TODO: add swagger docs
    public function index(){
        #TODO: try catch or handle in handler for http requests
        #TODO: create collection resource for the models pagination as well
        return new SuccessResponse("Record Lists fetched",RecordList::all());
    }


    public function store(Request $request){
        #REVIEW: may want to use save method, not sure about what to use
        $recordList = RecordList::create([
            'list_name' => $request->list_name,
        ]);

        return new SuccessResponse("Record List created successfully",["id"=>$recordList->id],Response::HTTP_CREATED); 
    }
}
