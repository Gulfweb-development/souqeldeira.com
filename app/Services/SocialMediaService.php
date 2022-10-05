<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class SocialMediaService
{
    public $connectionToTwitter;
    public $title;
    public $imageUrl;

    public function __construct($title, $imageUrl)
    {
        $this->title = $title;
        $this->imageUrl = $imageUrl;
    }

    public function publishToTwitter()
    {
        $this->connectToTwitter();
        $imageMedia = $this->connectionToTwitter->upload('media/upload', ['media' => $this->imageUrl]);
        $parameters = [
            "status" => $this->title,
            "media_ids" => $imageMedia->media_id_string
        ];
        return $statuses = $this->connectionToTwitter->post("statuses/update", $parameters);
    }

    public function connectToTwitter()
    {
        // CONNECT TO TWITTER
        $this->connectionToTwitter = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
        // OVERRIDE TO TIME OUT TO FIX ERROR 5000 MS
        return $this->connectionToTwitter->setTimeouts(10, 50000);
    }
}
