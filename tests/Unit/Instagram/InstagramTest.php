<?php

namespace Tests\Unit\Instagram;

use Illuminate\Support\Collection;
use Tests\TestCase;

class InstagramTest extends TestCase
{
    /**
     *@test
     */
    public function recent_images_can_be_fetched_from_instagram_with_fake_client()
    {
        $this->app->bind(\App\Instagram\InstagramClient::class, function() {
            return new \App\Instagram\FakeInstagramClient;
        });

        $images = \Instagram::recent();

        $this->assertInstanceOf(Collection::class, $images);

        $images->each(function($image) {
            $this->assertEquals('TEST_SRC_LOW', $image['src_low']);
            $this->assertEquals('TEST_SRC_STD', $image['src_std']);
        });
    }

    /**
     *@test
     *@group integration
     */
    public function a_collection_of_images_can_be_fetched_with_real_client()
    {
        $images = \Instagram::recent();

        $this->assertInstanceOf(Collection::class, $images);

        $images->each(function($image) {
            $this->assertContains('https://instagram', $image['src_low']);
            $this->assertContains('https://instagram', $image['src_std']);
        });
    }
}