<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatedUser extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    private string $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject('Acesso a plataforma.');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mail.user-created', [
            'user' => $this->user,
            'password' => $this->password
        ]);
    }
}
