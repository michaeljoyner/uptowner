<?php

namespace App\Instagram;


use michaeljoyner\SimpleJsonEndpoint\SimpleJsonEndpoint;

class Instagram extends SimpleJsonEndpoint
{

    protected $cache_key = 'uptowner_instagram_feed';

    protected $cache_minutes = 2800;


    protected function getEndpointUrl(array $options = [])
    {
        return "https://www.instagram.com/{$options['username']}?__a=1";
    }

    protected function parseResponse($response)
    {
        $hasMedia = $response['graphql']['user']['edge_owner_to_timeline_media']['edges'] ?? null;
        if(!$hasMedia) {
            return [];
        }
        return collect($response['graphql']['user']['edge_owner_to_timeline_media']['edges'])->map(function($image) {
            return [
                'thumbnail' => $image['node']['thumbnail_resources'][2]['src'] ?? '',
                'low' => $image['node']['thumbnail_resources'][3]['src'] ?? '',
                'standard' => $image['node']['thumbnail_resources'][4]['src'] ?? ''
            ];
        });
    }
}