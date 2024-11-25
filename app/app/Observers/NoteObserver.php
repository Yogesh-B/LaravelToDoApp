<?php

namespace App\Observers;

use App\Models\Acl;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteObserver
{
    /**
     * Handle the Note "created" event.
     */
    public function created(Note $note): void
    {
        $user = Auth::user();
        Acl::create([
            'user_id' => $user->id,
            'entity_type' => 'note',
            'entity_id' => $note->id,
            'permission' => 'owner',
        ]);
    }

    /**
     * Handle the Note "updated" event.
     */
    public function updated(Note $note): void
    {
        //
    }

    /**
     * Handle the Note "deleted" event.
     */
    public function deleted(Note $note): void
    {
        //
    }

    /**
     * Handle the Note "restored" event.
     */
    public function restored(Note $note): void
    {
        //
    }

    /**
     * Handle the Note "force deleted" event.
     */
    public function forceDeleted(Note $note): void
    {
        //
    }
}
