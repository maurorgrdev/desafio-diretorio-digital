<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EdicaoUsuarioNotificacao extends Notification
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
                    ->line('Os dados da sua empresa foram alterados.')
                    ->action('Acessar Sistema', url('/'))
                    ->line('Segue abaixo suas credenciais:')
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
