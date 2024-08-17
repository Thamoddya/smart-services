<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VehicleAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vehicle;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @param  $vehicle
     * @param  $customer
     * @return void
     */
    public function __construct($vehicle, $customer)
    {
        $this->vehicle = $vehicle;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.vehicle_added')
            ->subject('Your Vehicle Has Been Added Successfully');
    }
}
