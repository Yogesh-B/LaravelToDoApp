<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordList extends Model
{
    use HasFactory;
    use SoftDeletes;

    #REVIEW: we could used some 'key' here, which we use in route for retrieving a row
    protected $fillable = [
        'list_name',
    ];
}
