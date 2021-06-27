<?php

namespace App\Jobs;

use App\Models\Client;
use App\Notifications\profileImageUploadReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProfileImagePodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = Client::where('profile_image', '=', '')->cursor();

        $client->each(function ($client) {
            /* @var Client $client */

            try {
                if ($client){
                    $client->notify(new profileImageUploadReminderNotification($client));
                }

            } catch (\Throwable $th) {
                logger();
            }
        });
    }
}
