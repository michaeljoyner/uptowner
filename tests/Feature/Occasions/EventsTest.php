<?php


namespace Tests\Feature\Occasions;


use App\Occasions\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_event_can_be_created()
    {
        $this->disableExceptionHandling();
        $event_data = [
            'time_of_day'    => 'all day',
            'zh_time_of_day' => 'zh all day',
            'name'           => 'Happy Hour',
            'zh_name'        => '満版復',
            'description'    => 'Sixty minutes of pure joy',
            'zh_description' => '永門義会可際査別件村約候証民'
        ];
        $response = $this->asLoggedInUser()->json('POST', '/admin/events',
            array_merge($event_data, ['event_date' => Carbon::parse('+5 days')->format('Y-m-d')]));
        $response->assertStatus(200);

        $this->assertTranslatableTableHas('events', $event_data);

        $this->assertCount(1, Event::all());
        $this->assertTrue(Event::first()->event_date->isSameDay(Carbon::parse('+5 days')));
    }

    /**
     *@test
     */
    public function an_event_may_be_updated()
    {
        $event = factory(Event::class)->create();
        $update_data = [
            'event_date' => Carbon::parse('+5 days')->format('Y-m-d'),
            'name' => 'An Event Apart',
            'description' => 'An exciting event at a locale near you'
        ];
        $expected_data = [
            'name' => 'An Event Apart',
            'zh_name' => $event->getTranslation('name', 'zh'),
            'description' => 'An exciting event at a locale near you',
            'zh_description' => $event->getTranslation('description', 'zh'),
            'time_of_day' => $event->time_of_day,
            'zh_time_of_day' => $event->getTranslation('time_of_day', 'zh')
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id, $update_data);
        $response->assertStatus(200);

        $this->assertTranslatableTableHas('events', $expected_data);
        $this->assertTrue(Event::first()->event_date->isSameDay(Carbon::parse('+5 days')));
    }

    /**
     *@test
     */
    public function an_event_can_be_deleted()
    {
        $event = factory(Event::class)->create();

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/events/' . $event->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}