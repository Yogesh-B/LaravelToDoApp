<?php

namespace App\Http\Controllers;

use App\Models\RecordList;
use Illuminate\Http\Request;

class RecordListController extends Controller
{
    #TODO: add swagger docs
    public function index(){
        #TODO: use http resource instead, you may want to consider pagination as well

        return RecordList::all();
    }


    public function store(Request $request){
        #TODO: may want to use save method, not sure about what to use
        $recordList = RecordList::create([
            'list_name' => $request->list_name,
        ]);

        return $recordList->id; 
    }
}
