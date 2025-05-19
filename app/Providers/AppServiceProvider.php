<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Atur Ulang Kata Sandi Anda')
                ->line('Kami menerima permintaan untuk mengatur ulang kata sandi Anda.')
                ->action('Reset Kata Sandi', $url)
                ->line('Jika Anda tidak meminta pengaturan ulang, abaikan saja email ini.')
                ->salutation('Salam hangat, Tim MI Hidayatul Ikhwan');

        });
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
