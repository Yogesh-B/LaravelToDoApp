<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Acl;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\RecordList::class => \App\Policies\RecordListPolicy::class,
        \App\Models\Note::class => \App\Policies\NotePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('grant-permission', function(User $user, $entityType, $entityId) {
            return Acl::where('user_id', $user->id)
            ->where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->where('permission', 'owner')
            ->exists();
        });
    }
}
