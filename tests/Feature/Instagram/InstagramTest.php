<?php


namespace Tests\Feature\Instagram;


use App\Instagram\FakeInstagramClient;
use App\Instagram\Instagram;
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
        $instagram = new Instagram();

        $instagram->fetch(['username' => 'dymanticdesign']);

        $this->assertNotEmpty(cache('uptowner_instagram_feed'));
    }
}