<?php

namespace App\Providers;

use App\Mail\PasswordResetMail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // Personalizar notificación de reset de contraseña
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url('/reset-password?token='.$token.'&email='.urlencode($user->email));
        });

        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $url = url('/reset-password?token='.$token.'&email='.urlencode($notifiable->email));
            $expires = config('auth.passwords.users.expire', 60);

            return new PasswordResetMail($notifiable, $url, $expires);
        });
    }

    /**
     * Configure the rate limiting for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $email = Str::transliterate(Str::lower($request->string('email')));

            return [
                'prefix' => 'login',
                'key' => $email.'|'.$request->ip(),
                'limit' => 5,
                'decay' => 60,
            ];
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return [
                'prefix' => 'two-factor',
                'limit' => 10,
                'decay' => 60,
            ];
        });

        RateLimiter::for('password-reset', function (Request $request) {
            return [
                'prefix' => 'password-reset',
                'key' => $request->string('email'),
                'limit' => 3,
                'decay' => 60,
            ];
        });
    }
}
