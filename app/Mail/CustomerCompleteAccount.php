<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * @property  pdf
 */
class CustomerCompleteAccount extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $user;

    private $pdf;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $pdf
     */
    public function __construct($user,$pdf)
    {

        $this->user = $user;

        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('loans@firstlinecredit.co.ke')
            ->subject('First Line Credit Account')
            ->attachData($this->pdf->output(), 'account-details.pdf', [
                'mime' => 'application/pdf',
            ])
            ->markdown('customer.mails.accountComplete');
    }
}
