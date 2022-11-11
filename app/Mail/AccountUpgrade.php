<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountUpgrade extends Mailable
{
    use Queueable, SerializesModels;
    protected $username;
    protected $account;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $account)
    {
        $this->username = $username;
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account_upgrade')
        ->with([
            'username' => $this->username,
            'account' => $this->account,
        ]);
    }
}