<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'list_id',
        'title',
        'description',
        'is_completed',
    ];

    public function list(){
        return $this->belongsTo(RecordList::class,'list_id','id');
    }

}
