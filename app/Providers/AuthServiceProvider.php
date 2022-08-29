<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Permission;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Post::class => \App\Policies\PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::before(function ($user) {
            return $user->hasViewPermission('supper-admin') ? true : null;
        });

        if(!$this->app->runningInConsole()) {
            foreach (Permission::all() as  $value) {
                Gate::define($value->name, function($user) use ($value) {
                    return $user->hasPermission($value);
                });
            }
        }
    }
}
