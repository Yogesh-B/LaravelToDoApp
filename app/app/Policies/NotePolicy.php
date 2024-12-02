<?php

namespace App\Policies;

use App\Models\Acl;
use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

    public function view(User $user, Note $note)
    {
        return Acl::where('user_id', $user->id)
            ->where('entity_type', 'note')
            ->where('entity_id', $note->id)
            ->exists();
    }

    public function edit(User $user, Note $note)
    {
        return Acl::where('user_id', $user->id)
            ->where('entity_type', 'note')
            ->where('entity_id', $note->id)
            ->whereIn('permission', ['editor', 'owner'])
            ->exists();
    }

    public function delete(User $user, Note $note)
    {
        return Acl::where('user_id', $user->id)
            ->where('entity_type', 'note')
            ->where('entity_id', $note->id)
            ->where('permission', 'owner')
            ->exists();
    }

}
