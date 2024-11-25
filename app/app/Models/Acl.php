<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acl extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'entity_type',
        'entity_id',
        'permission',
    ];

    public function acl(): MorphTo
    {
        return $this->morphTo(__FUNCTION__,'entity_type','entity_id');
    }
}
