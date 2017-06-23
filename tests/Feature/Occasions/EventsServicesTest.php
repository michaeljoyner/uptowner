<?php


namespace Tests\Feature\Occasions;


use App\Occasions\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EventsServicesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_list_of_all_events_can_be_fetched()
    {
        $this->disableExceptionHandling();
        $created_events = factory(Event::class, 10)->create();

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/events');
        $response->assertStatus(200);

        $fetched_events = $response->decodeResponseJson();

        $this->assertCount(10, $fetched_events);

        collect($fetched_events)->each(function($fetched_event) use ($created_events) {
            $this->assertContains($fetched_event['id'], $created_events->pluck('id')->toArray());
        });
    }
}