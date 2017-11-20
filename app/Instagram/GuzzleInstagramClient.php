<?php


namespace App\Instagram;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class GuzzleInstagramClient implements InstagramClient
{

    private $http;

    public function __construct()
    {
        $this->http = new Client();
    }

    public function fetch()
    {
        $url = 'https://instagram.com/' . config('services.instagram.username') . '?__a=1';

        $images = Cache::remember('instagram_feed', 60 * 24, function() use ($url) {
            try {
                $response = \GuzzleHttp\json_decode($this->http->get($url)->getBody()->getContents(), true);
                return collect($response['user']['media']['nodes'])->map(function($image) {
                    return [
                        'src_low' => $image['thumbnail_resources'][3]['src'] ?? '',
                        'src_std' => $image['thumbnail_resources'][4]['src'] ?? ''
                    ];
                });
            } catch(\Exception $e) {
                return collect([]);
            }
        });

        return $images;
    }
}