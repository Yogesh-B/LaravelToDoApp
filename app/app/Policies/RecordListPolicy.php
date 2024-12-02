<?php

namespace App\Policies;

use App\Models\Acl;
use App\Models\RecordList;
use App\Models\User;

class RecordListPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, RecordList $recordList)
    {
        return Acl::where('user_id', $user->id)
            ->where('entity_type', 'list')
            ->where('entity_id', $recordList->id)
            ->exists();
    }

    public function edit(User $user, RecordList $recordList)
    {
        return Acl::where('user_id', $user->id)
            ->where('entity_type', 'list')
            ->where('entity_id', $recordList->id)
            ->whereIn('permission', ['editor', 'owner'])
            ->exists();
    }

    public function delete(User $user, RecordList $recordList)
    {
        return Acl::where('user_id', $user->id)
            ->where('entity_type', 'list')
            ->where('entity_id', $recordList->id)
            ->where('permission', 'owner')
            ->exists();
    }

}
