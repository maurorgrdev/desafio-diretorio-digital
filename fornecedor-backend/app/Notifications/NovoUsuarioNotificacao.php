<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NovoUsuarioNotificacao extends Notification
{
    use Queueable;
    
    private $email ;
    private $senha ;

    /**
     * Create a new notification instance.
     */
    public function __construct($email, $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Bem vindo ao teste da Diretorio Digital.')
                    ->action('Acessar Sistema', url('/'))
                    ->line('Obrigado por fazer parte do nosso time! Segue abaixo  suas credenciais:')
                    ->line('Email: '. $this->email)
                    ->line('Senha: '. $this->senha);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
