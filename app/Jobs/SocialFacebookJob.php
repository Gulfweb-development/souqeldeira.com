<?php

namespace App\Jobs;

use Facebook\Facebook;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SocialFacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $title;

    public $imageUrl;

    public $connectionToFacebook;
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
        $this->connectionToFacebook = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v12.0',
            'default_access_token' => env('FACEBOOK_PAGE_ACCESS_TOKEN'), // optional
        ]);

        try {
            // $imageUrl = public_path('images/video_bg.jpg');
            // $imageUrl = url('/');
            // dd($imageUrl.'/images/popup1.jpg');
            $response = $this->connectionToFacebook->post('106808981764636/photos', [
                'message' => $this->title,
                'source' => $this->connectionToFacebook->fileToUpload($this->imageUrl),
                // 'link' => 'https://test.aldeiramarket.com',
                // 'url' => 'https://images.pexels.com/photos/931177/pexels-photo-931177.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                // 'url' => "${imageUrl}",
            ])->getGraphNode()->asArray();
            // $fb->fileToUpload($imageUrl);
            if ($response['id']) {
                // post created
                dd($response, 'PHOTO PUBLISHED');
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
    }
}
