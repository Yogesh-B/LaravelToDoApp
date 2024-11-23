<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @OA\Schema(
     *      schema="Note",
     *      title="Notes",
     *      description="A model representing a note",
     *      @OA\Property(
     *          property="id",
     *          type="integer",
     *          description="ID of the note"
     *      ),
     *      @OA\Property(
     *          property="owner_id",
     *          type="integer",
     *          description="ID of the user who owns the note"
     *      ),
     *      @OA\Property(
     *          property="record_list_id",
     *          type="integer",
     *          description="Id of the record list that the note belongs to"
     *      ),
     *      @OA\Property(
     *          property="title",
     *          type="string",
     *          description="Title of the note"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          type="text",
     *          description="Description of the note"
     *      ),
     *      @OA\Property(
     *          property="is_completed",
     *          type="boolean",
     *          description="completion status for notes, true or false"
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          type="string",
     *          format="date-time",
     *          description="Date and time when the record list was created"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          type="string",
     *          format="date-time",
     *          description="Date and time when the record list was last updated"
     *      ),
     *      @OA\Property(
     *          property="deleted_at",
     *          type="string",
     *          format="date-time",
     *          description="Date and time when the record list was deleted (for soft deletes)"
     *      )
     *) 
     */
    protected $fillable = [
        'owner_id',
        'record_list_id',
        'title',
        'description',
        'is_completed',
    ];

    public function list(){
        return $this->belongsTo(RecordList::class,'record_list_id','id');
    }

}
