<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;


class PermissionEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $first_name, $last_name, $email, $password)
    {
        $this->user = $user;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
    }

     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_account_created')
                    ->subject('School Management System Registeration!');
    }
    
}
