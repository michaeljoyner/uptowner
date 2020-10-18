<?php


namespace Tests\Feature\Occasions;


use App\Occasions\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EventsServicesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_list_of_all_events_can_be_fetched_in_correct_format()
    {
        $this->disableExceptionHandling();
        $created_events = factory(Event::class, 10)->create([
            'name' => ['en' => 'TEST NAME', 'zh' => '満版復'],
            'description' => ['en' => 'TEST DESCRIPTION', 'zh' => '永門義会可際査別件村約候証民'],
            'long_description' => ['en' => 'LONG TEST DESCRIPTION', 'zh' => '永門義会可際査別件村約候証民。昌原集前全者波有索男討家王合考作染美最。催優際田度読賞督密出将育別容'],
            'event_date' => Carbon::now(),
            'time_of_day' => ['en' => 'TEST TIME', 'zh' => '満版復'],
            'published' => true
        ]);

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/events');
        $response->assertStatus(200);

        $fetched_events = $response->json();

        $this->assertCount(10, $fetched_events);

        collect($fetched_events)->each(function($fetched_event) use ($created_events) {
            $this->assertContains($fetched_event['id'], $created_events->pluck('id')->toArray());
            $this->assertEquals('TEST NAME', $fetched_event['name']);
            $this->assertEquals('満版復', $fetched_event['zh_name']);
            $this->assertEquals('TEST DESCRIPTION', $fetched_event['description']);
            $this->assertEquals('永門義会可際査別件村約候証民', $fetched_event['zh_description']);
            $this->assertEquals('LONG TEST DESCRIPTION', $fetched_event['long_description']);
            $this->assertEquals(
                '永門義会可際査別件村約候証民。昌原集前全者波有索男討家王合考作染美最。催優際田度読賞督密出将育別容',
                $fetched_event['zh_long_description']
            );
            $this->assertEquals('TEST TIME', $fetched_event['time_of_day']);
            $this->assertEquals('満版復', $fetched_event['zh_time_of_day']);
            $this->assertEquals(Carbon::now()->format('Y-m-d'), $fetched_event['event_date']);
            $this->assertTrue($fetched_event['published']);
            $this->assertArrayHasKey('image', $fetched_event);
            $this->assertArrayHasKey('image_id', $fetched_event);
            $this->assertArrayHasKey('featured', $fetched_event);
        });
    }
}