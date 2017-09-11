<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Mail\Mailer;
use App\Entrie;
use App\Mail\EntryCreatedMD;
use App\Mail\EntryCreated;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recipients, $entry;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailData, Entrie $model)
    {
        //
        $this->recipients = $mailData;
        $this->entry = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($data)
    {
        //
        /*$mailer->send('entries.print', $data, function ($message) use ($data){       

            $message->to($data['email'])->subject($data['subject']);

        });*/
        Mail::to($this->recipients)->send(new EntryCreatedMD($this->entry));
        //Mail::to($this->recipients)->send(new EntryCreatedMD($this->entry));
    }
}
