<?php


namespace Tests\Feature\Occasions;


use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EventsValidationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_event_requires_a_date_to_be_created()
    {
        $event_data = [
            'name' => 'An Event Apart',
            'description' => 'A community event'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events', $event_data);

        $response->assertStatus(422);
        $response->assertJsonStructure(['event_date']);
    }

    /**
     *@test
     */
    public function the_event_date_must_be_a_valid_date()
    {
        $event_data = [
            'event_date' => '999-55-88',
            'name' => 'An Event Apart',
            'description' => 'A community event'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events', $event_data);

        $response->assertStatus(422);
        $response->assertJsonStructure(['event_date']);
    }

    /**
     *@test
     */
    public function the_event_date_cannot_be_in_the_past()
    {
        $event_data = [
            'event_date' => Carbon::parse('-5 days')->format('Y-m-d'),
            'name' => 'An Event Apart',
            'description' => 'A community event'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events', $event_data);

        $response->assertStatus(422);
        $response->assertJsonStructure(['event_date']);
    }

    /**
     *@test
     */
    public function an_event_must_have_either_an_english_or_a_chinese_name()
    {
        $event_data = [
            'event_date' => Carbon::parse('+5 days')->format('Y-m-d'),
            'description' => 'A community event'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events', $event_data);

        $response->assertStatus(422);
        $response->assertJsonStructure(['name']);
    }

    /**
     *@test
     */
    public function an_event_can_have_just_a_zh_name()
    {
        $event_data = [
            'event_date' => Carbon::parse('+5 days')->format('Y-m-d'),
            'zh_name' => '満版復',
            'description' => 'A community event'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events', $event_data);

        $response->assertStatus(200);
    }

    /**
     *@test
     */
    public function an_event_can_have_just_an_english_name()
    {
        $event_data = [
            'event_date' => Carbon::parse('+5 days')->format('Y-m-d'),
            'name' => 'English Name',
            'description' => 'A community event'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/events', $event_data);

        $response->assertStatus(200);
    }
}