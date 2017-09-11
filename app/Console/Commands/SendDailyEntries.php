<?php

namespace App\Console\Commands;

use Mail;
use App\Entrie;
use App\Notification;
use App\Mail\DailyEntries;
use Illuminate\Console\Command;

class SendDailyEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de correo diario con los registros del dia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $notifications = Notification::where('status','A')
                        ->where('conditions','LIKE','%cron%')
                        ->get();

        if (!$notifications->isEmpty()) {
            foreach ($notifications as $notification) {   
                $entryConditions = [];         
                $conditions = json_decode($notification->conditions, true);
                $recipients = explode(',', $conditions['recipient']);
                $entries = Entrie::
                        whereIn('operation_id', $conditions['operation'])
                        ->whereIn('categorie_id', $conditions['category'])
                        ->whereIn('companie_id', $conditions['company'])
                        ->when(isset($conditions['material']), function($query) use ($conditions){
                            return $query->whereIn('material_id', $conditions['material']);
                    })
                    ->orderBy('time')->get();
                //dd($entries);
                if (!$entries->isEmpty()) {               
                    Mail::to($recipients)->send(new DailyEntries($entries));
                }            
            }   
        } 
        $this->info('Se enviaron los correos.');              
    }

}
