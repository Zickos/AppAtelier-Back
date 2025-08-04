<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\{
    Vehicle,
    Retrofit,
    Planning,
    Demande,
    Photo,
    User
};

use App\Policies\{
    VehiclePolicy,
    RetrofitPolicy,
    PlanningPolicy,
    DemandePolicy,
    PhotoPolicy,
    UserPolicy
};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vehicle::class   => VehiclePolicy::class,
        Retrofit::class  => RetrofitPolicy::class,
        Planning::class  => PlanningPolicy::class,
        Demande::class   => DemandePolicy::class,
        Photo::class     => PhotoPolicy::class,
        User::class      => UserPolicy::class,
    ];

    /**
     * Bootstrap any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
