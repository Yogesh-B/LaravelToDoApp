<?php

namespace App\Observers;

use App\Models\Acl;
use App\Models\RecordList;
use Illuminate\Support\Facades\Auth;

class RecordListObserver
{
    /**
     * Handle the RecordList "created" event.
     */
    public function created(RecordList $recordList): void
    {
        $user = Auth::user();
        Acl::create([
            'user_id' => $user->id,
            'entity_type' => 'list',
            'entity_id' => $recordList->id,
            'permission' => 'owner',
        ]);
    }

    /**
     * Handle the RecordList "updated" event.
     */
    public function updated(RecordList $recordList): void
    {
        //
    }

    /**
     * Handle the RecordList "deleted" event.
     */
    public function deleted(RecordList $recordList): void
    {
        //
    }

    /**
     * Handle the RecordList "restored" event.
     */
    public function restored(RecordList $recordList): void
    {
        //
    }

    /**
     * Handle the RecordList "force deleted" event.
     */
    public function forceDeleted(RecordList $recordList): void
    {
        //
    }
}
