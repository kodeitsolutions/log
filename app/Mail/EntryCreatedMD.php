<?php

namespace App\Mail;

use App\Entrie;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryCreatedMD extends Mailable
{
    use Queueable, SerializesModels;

    public $entry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Entrie $model)
    {
        //
        $this->entry = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registro creado.')
                    ->markdown('entries.mail')
                    ->with('entry', $this->entry);
    }
}
