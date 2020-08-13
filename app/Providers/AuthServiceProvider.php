<?php

namespace App\Providers;

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
<<<<<<< HEAD
        'App\Post' => 'App\Policies\PostPolicy',
=======
        // 'App\Model' => 'App\Policies\ModelPolicy',
>>>>>>> f46b3bf6b1ed28d4480a72810b912d911b98d350
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

<<<<<<< HEAD
        Gate::before(function ($user) {
            return $user->isAdmin() ? true : null;
        });
=======
        //
>>>>>>> f46b3bf6b1ed28d4480a72810b912d911b98d350
    }
}
