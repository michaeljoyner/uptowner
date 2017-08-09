<?php


namespace Tests\Feature\Instagram;


use App\Instagram\FakeInstagramClient;
use App\Instagram\InstagramClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class InstagramTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_list_of_recent_instagram_posts_can_be_fetched()
    {
        $this->app->bind(InstagramClient::class, FakeInstagramClient::class);

        $response = $this->json('GET', '/service/instagram/feed');
        $response->assertStatus(200);

        $images = $response->decodeResponseJson();

        collect($images)->each(function($image) {
            $this->assertContains('TEST_SRC_LOW', $image['src_low']);
            $this->assertContains('TEST_SRC_STD', $image['src_std']);
        });
    }
}