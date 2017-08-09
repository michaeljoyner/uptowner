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
        $url = 'https://instagram.com/' . config('services.instagram.username') . '/media';

        $images = Cache::remember('instagram_feed', 60 * 24, function() use ($url) {
            try {
                $response = \GuzzleHttp\json_decode($this->http->get($url)->getBody()->getContents(), true);
                return collect($response['items'] ?? [])->map(function($item) {
                    return [
                        'src_low' => $item['images']['low_resolution']['url'] ?? '',
                        'src_std' => $item['images']['standard_resolution']['url'] ?? '',
                    ];
                });
            } catch(\Exception $e) {
                return collect([]);
            }
        });

        return $images;
    }
}