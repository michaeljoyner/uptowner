<?php


namespace Tests\Feature\Occasions;


use App\Occasions\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EventPublishingTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_event_can_be_published()
    {
        $event = factory(Event::class)->create(['published' => false]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id . '/publish',
            ['published' => true]);
        $response->assertStatus(200);
        $this->assertEquals(['new_status' => true], $response->json());
    }

}