<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Confirme seu E-mail - ' . config('app.name'))
                ->greeting('Olá, ' . explode(' ', $notifiable->name)[0] . '!')
                ->line('Falta pouco! Por favor, clique no botão abaixo para confirmar seu endereço de e-mail e liberar o seu acesso à nossa loja.')
                ->action('Confirmar meu E-mail', $url)
                ->line('Se você não criou uma conta em nosso site, pode ignorar este e-mail tranquilamente.')
                ->salutation('Atenciosamente, Equipe Instrumental Store');
        });
    }
}