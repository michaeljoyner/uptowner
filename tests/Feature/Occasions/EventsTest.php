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
            'zh_description' => '永門義会可際査別件村約候証民',
            'long_description' => 'This is a full bodied description of the event',
            'zh_long_description' => '永門義会可際査別件村約候証民。昌原集前全者波有索男討家王合考作染美最。催優際田度読賞督密出将育別容'
        ];
        $response = $this->asLoggedInUser()->json('POST', '/admin/events',
            array_merge($event_data, ['event_date' => Carbon::parse('+5 days')->format('Y-m-d')]));
        $response->assertStatus(200);

        $this->assertTranslatableTableHas('events', $event_data);

        $this->assertCount(1, Event::all());
        $this->assertTrue(Event::first()->event_date->isSameDay(Carbon::parse('+5 days')));
    }

    /**
     * @test
     */
    public function an_event_can_be_created_with_a_long_form_date_time_string()
    {
        $this->disableExceptionHandling();
        $event_data = [
            'time_of_day'    => 'all day',
            'zh_time_of_day' => 'zh all day',
            'name'           => 'Happy Hour',
            'zh_name'        => '満版復',
            'description'    => 'Sixty minutes of pure joy',
            'zh_description' => '永門義会可際査別件村約候証民',
            'long_description' => 'This is a full bodied description of the event',
            'zh_long_description' => '永門義会可際査別件村約候証民。昌原集前全者波有索男討家王合考作染美最。催優際田度読賞督密出将育別容'
        ];
        $response = $this->asLoggedInUser()->json('POST', '/admin/events',
            array_merge($event_data, ['event_date' => Carbon::parse('+5 days')->format('Y-m-d') . 'T00:00:00.000Z']));
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
            'description' => 'An exciting event at a locale near you',
            'long_description' => 'This is a whole new description'
        ];
        $expected_data = [
            'name' => 'An Event Apart',
            'zh_name' => $event->getTranslation('name', 'zh'),
            'description' => 'An exciting event at a locale near you',
            'zh_description' => $event->getTranslation('description', 'zh'),
            'time_of_day' => $event->time_of_day,
            'zh_time_of_day' => $event->getTranslation('time_of_day', 'zh'),
            'long_description' => 'This is a whole new description',
            'zh_long_description' => $event->getTranslation('long_description', 'zh'),
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id, $update_data);
        $response->assertStatus(200);

        $this->assertTranslatableTableHas('events', $expected_data);
        $this->assertTrue(Event::first()->event_date->isSameDay(Carbon::parse('+5 days')));
    }
    
    /**
     *@test
     */
    public function an_update_request_returns_the_updated_data_in_the_correct_format()
    {
        $event = factory(Event::class)->create();
        $update_data = [
            'event_date' => Carbon::parse('+5 days')->format('Y-m-d'),
            'name' => 'An Event Apart',
            'description' => 'An exciting event at a locale near you'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id, $update_data);
        $response->assertStatus(200);

        $updated_data = $response->decodeResponseJson();
        $event = $event->fresh();

        $this->assertEquals($event->fresh()->toJsonableArray(), $updated_data);

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