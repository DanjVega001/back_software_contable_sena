<?php

namespace App\Providers;

use App\Modules\Shared\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Passport::routes();
    }

    /**
     * Roles de la aplicación
     */
    public const admin = 'admin',
    instructor = 'instructor',
    aprendiz = 'aprendiz';

    public const admin_id = 1,
    instructor_id = 2,
    aprendiz_id = 3;

    public static function getRole(User $user = null) : string
    {
        return self::getUserModel($user ?? auth()->user())->role->nombre;
    }

    public static function getUserModel(Authenticatable $authUser) : User
    {
        return User::with('role')->find($authUser->id);
    }

}
