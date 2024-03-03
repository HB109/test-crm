<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PostMailSendUser;
use Mail;

class SendEmailPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
         $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $address = 'martinhen737@gmail.com';
        $name = 'My Project';

        $email = new PostMailSendUser();
        Mail::to($this->data['email'],'Admin')->send($email);
    }
}
