<?php

namespace Tests\Unit\Specials;

use App\Specials\Special;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SpecialsTest extends TestCase {

    use DatabaseMigrations;

    /**
     *@test
     */
    public function current_specials_can_be_queried()
    {
        $specialA = factory(Special::class)->create([
            'start_date' => Carbon::parse('-13 days'),
            'end_date' => Carbon::parse('-2 days'),
            'published' => true
        ]);

        $specialB = factory(Special::class)->create([
            'start_date' => Carbon::parse('-3 days'),
            'end_date' => Carbon::parse('+5 days'),
            'published' => true
        ]);

        $specialC = factory(Special::class)->create([
            'start_date' => Carbon::parse('-2 days'),
            'end_date' => Carbon::parse('+12 days'),
            'published' => false
        ]);

        $specialD = factory(Special::class)->create([
            'start_date' => Carbon::parse('+2 days'),
            'end_date' => Carbon::parse('+14 days'),
            'published' => true
        ]);

        $current_specials = Special::current();

        $this->assertCount(2, $current_specials);
        $this->assertContains($specialB->id, $current_specials->pluck('id')->all());
        $this->assertContains($specialD->id, $current_specials->pluck('id')->all());
    }

    /**
     *@test
     */
    public function a_special_is_expired_if_the_end_date_has_passed()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::parse('-13 days'),
            'end_date' => Carbon::parse('-2 days')
        ]);

        $this->assertTrue($special->isExpired());
    }

    /**
     *@test
     */
    public function a_special_is_not_expired_if_the_end_day_is_today()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::parse('-13 days'),
            'end_date' => Carbon::now()
        ]);

        $this->assertFalse($special->isExpired());
    }

    /**
     *@test
     */
    public function a_special_with_both_start_and_end_date_in_the_future_has_a_reasonable_time_window()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::parse('+3 days'),
            'end_date' => Carbon::parse('+10 days')
        ]);

        $expected = 'Available from ' . Carbon::parse('+3 days')->format('jS M, Y') . ' until ' . Carbon::parse('+10 days')->format('jS M, Y');

        $this->assertEquals($expected, $special->timeWindow());
    }

    /**
     *@test
     */
    public function an_special_that_has_already_started_has_an_appropriate_time_window()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::parse('-3 days'),
            'end_date' => Carbon::parse('+10 days')
        ]);

        $expected = 'Available until ' . Carbon::parse('+10 days')->format('jS M, Y');

        $this->assertEquals($expected, $special->timeWindow());
    }
}