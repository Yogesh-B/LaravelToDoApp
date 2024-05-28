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
}
