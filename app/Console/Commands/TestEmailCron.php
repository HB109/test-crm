<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class TestEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data= ['data'=>'mail testing'];
        Mail::send('mail.company_mail', [], function($message){
            $message->to('martinhen737@gmail.com')
                    ->cc('baghel083@gmail.com')
                    ->subject('First comapny send mail');
        });
        \Log::info('handle cron job');
    }
}
