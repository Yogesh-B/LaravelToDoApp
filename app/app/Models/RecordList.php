<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordList extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @OA\Schema(
     *     schema="RecordList",
     *     title="Record List",
     *     description="A model representing a record list",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="ID of the record list"
     *     ),
     *     @OA\Property(
     *         property="owner_id",
     *         type="integer",
     *         description="ID of the user who owns the record list"
     *     ),
     *     @OA\Property(
     *         property="list_name",
     *         type="string",
     *         description="Name of the record list"
     *     ),
     *     @OA\Property(
     *         property="created_at",
     *         type="string",
     *         format="date-time",
     *         description="Date and time when the record list was created"
     *     ),
     *     @OA\Property(
     *         property="updated_at",
     *         type="string",
     *         format="date-time",
     *         description="Date and time when the record list was last updated"
     *     ),
     *     @OA\Property(
     *         property="deleted_at",
     *         type="string",
     *         format="date-time",
     *         description="Date and time when the record list was deleted (for soft deletes)"
     *     )
     * )
    */



    #REVIEW: we could used some 'key' here, which we use in route for retrieving a row
    protected $fillable = [
        'owner_id',
        'list_name',
    ];


    public function notes(){
        return $this->hasMany(Note::class,'record_list_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'owner_id','id');
    }

    public function acls(): MorphMany
    {
        return $this->morphMany(Acl::class, 'acl');
    }

}
