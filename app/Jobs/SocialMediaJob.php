<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\SocialMediaService;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SocialMediaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $title;

    public $imageUrl;

    public $connectionToTwitter;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $imageUrl)
    {
        //
        $this->title = $title;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // PUBLISH TO TITTER
        $this->connectionToTwitter = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
        $this->connectionToTwitter->setTimeouts(10, 50000);
        $imageMedia = $this->connectionToTwitter->upload('media/upload', ['media' => $this->imageUrl]);
        $parameters = [
            "status" => $this->title,
            "media_ids" => $imageMedia->media_id_string
        ];
        $statuses = $this->connectionToTwitter->post("statuses/update", $parameters);
        // PUBLISH TO FACEBOOK

    }
}
