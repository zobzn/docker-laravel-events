<?php

namespace App\Providers;

use App\Model\Event;
use App\Model\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('event.view', function (User $user, Event $event) {
            return $user->id == $event->user_id;
        });

        Gate::define('event.edit', function (User $user, Event $event) {
            return $user->id == $event->user_id;
        });
    }
}
