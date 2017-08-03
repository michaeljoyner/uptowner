<?php


namespace Tests\Feature\Occasions;


use App\Occasions\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EventFeaturingTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_event_can_be_featured()
    {
        $this->disableExceptionHandling();
        $event = factory(Event::class)->create(['featured' => false]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id . '/feature', [
            'feature' => true
        ]);
        $response->assertStatus(200);
        $response->assertJson(['new_status' => true]);

        $this->assertDatabaseHas('events', ['id' => $event->id, 'featured' => true]);
    }

    /**
     *@test
     */
    public function an_event_can_be_un_featured()
    {
        $this->disableExceptionHandling();
        $event = factory(Event::class)->create(['featured' => true]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id . '/feature', [
            'feature' => false
        ]);
        $response->assertStatus(200);
        $response->assertJson(['new_status' => false]);

        $this->assertDatabaseHas('events', ['id' => $event->id, 'featured' => false]);
    }
}