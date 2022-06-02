<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-admins', function (User $user) {
            return $user->role_id == 1;
        });

        Gate::define('manage-veterinarian', function (User $user) {
            return $user->role_id == 2;
        });
        Gate::define('manage-users', function (User $user) {
            return $user->role_id == 3;
        });
    }
}
