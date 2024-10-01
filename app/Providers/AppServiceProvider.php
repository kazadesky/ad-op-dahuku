<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useTailwind();
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Alamat Email Anda')
                ->line('Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini.')
                ->action('Verifikasi Alamat Email', $url)
                ->line('Jika Anda tidak membuat akun, tidak ada tindakan lebih lanjut yang diperlukan.');
        });
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return "http://localhost:8000/reset-password?token=" . $token;
        });
    }
}
