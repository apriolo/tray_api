<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Sale;


class SaleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;
    public $totalValue;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sales, $totalValue)
    {
        $this->sales = $sales;
        $this->totalValue = $totalValue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Daily Report')
            ->view('sales.index');
    }
}
