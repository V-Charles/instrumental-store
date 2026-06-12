<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
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

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Recuperação de Senha - ' . config('app.name'))
                ->greeting('Olá!')
                ->line('Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para a sua conta.')
                ->action('Redefinir Senha', $url)
                ->line('Este link de redefinição de senha expirará em 60 minutos.')
                ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.')
                ->salutation('Atenciosamente, Equipe ' . config('app.name'));
        });
    }
}