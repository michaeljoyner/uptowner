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
    public function an_unpublished_special_with_a_current_time_window_is_not_considered_current()
    {
        factory(Special::class)->create([
            'start_date' => Carbon::parse('-2 days'),
            'end_date' => Carbon::parse('+12 days'),
            'published' => false
        ]);
        $this->assertCount(1, Special::all());

        $this->assertCount(0, Special::current());
    }

    /**
     *@test
     */
    public function an_unpublished_special_without_start_and_end_times_is_not_current()
    {
        factory(Special::class)->create([
            'start_date' => null,
            'end_date' => null,
            'published' => false
        ]);
        $this->assertCount(1, Special::all());

        $this->assertCount(0, Special::current());
    }

    /**
     *@test
     */
    public function a_published_special_with_no_start_or_end_times_is_considered_current()
    {
        $special = factory(Special::class)->create([
            'start_date' => null,
            'end_date' => null,
            'published' => true
        ]);

        $this->assertCount(1, Special::current());
        $this->assertTrue(Special::current()->first()->is($special));
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
            'end_date' => Carbon::parse('+10 days'),
            'published' => true
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
            'end_date' => Carbon::parse('+10 days'),
            'published' => true
        ]);

        $expected = 'Available until ' . Carbon::parse('+10 days')->format('jS M, Y');

        $this->assertEquals($expected, $special->timeWindow());
    }

    /**
     *@test
     */
    public function a_special_that_has_null_dates_has_an_appropriately_null_time_window()
    {
        $special = factory(Special::class)->create([
            'start_date' => null,
            'end_date' => null,
            'published' => true
        ]);

        $this->assertNull($special->timeWindow());
    }

    /**
     *@test
     */
    public function a_special_that_has_already_begun_and_has_no_end_date_has_a_null_time_window()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::parse('-3 days'),
            'end_date' => null,
            'published' => true
        ]);

        $this->assertNull($special->timeWindow());
    }

    /**
     *@test
     */
    public function a_special_with_only_a_start_date_in_the_future_has_an_appropriate_window()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::parse('+3 days'),
            'end_date' => null,
            'published' => true
        ]);

        $expected = 'Available from ' . Carbon::parse('+3 days')->format('jS M, Y');

        $this->assertEquals($expected, $special->timeWindow());
    }

    /**
     *@test
     */
    public function a_special_that_only_has_an_end_date_in_the_future_has_an_appropriate_time_window()
    {
        $special = factory(Special::class)->create([
            'start_date' => null,
            'end_date' => Carbon::parse('+10 days'),
            'published' => true
        ]);

        $expected = 'Available until ' . Carbon::parse('+10 days')->format('jS M, Y');

        $this->assertEquals($expected, $special->timeWindow());
    }

    /**
     *@test
     */
    public function an_expired_special_has_an_appropriate_time_window()
    {
        $old = factory(Special::class)->create([
            'start_date' => Carbon::parse('-14 days'),
            'end_date' => Carbon::parse('-10 days'),
            'published' => true
        ]);

        $old_and_null = factory(Special::class)->create([
            'start_date' => null,
            'end_date' => Carbon::parse('-10 days'),
            'published' => true
        ]);

        $unpublised = factory(Special::class)->create([
            'start_date' => null,
            'end_date' => Carbon::parse('+10 days'),
            'published' => false
        ]);

        $this->assertEquals('Sorry, this special is not currently valid', $old->timeWindow());
        $this->assertEquals('Sorry, this special is not currently valid', $old_and_null->timeWindow());
        $this->assertEquals('Sorry, this special is not currently valid', $unpublised->timeWindow());
    }

    /**
     *@test
     */
    public function a_special_can_present_itself_as_a_jsonable_array()
    {
        $special = factory(Special::class)->create([
            'title' => ['en' => 'TEST SPECIAL', 'zh' => '満版復'],
            'description' => ['en' => 'TEST DESCRIPTION', 'zh' => '永門義会可際査別件村約候証民'],
            'price' => 150,
            'start_date' => Carbon::today(),
            'end_date' => null,
            'published' => true
        ]);

        $expected =  [
            'id' => $special->id,
            'image' => Special::DEFAULT_IMG_URL,
            'title' => 'TEST SPECIAL',
            'zh_title' => '満版復',
            'description' => 'TEST DESCRIPTION',
            'zh_description' => '永門義会可際査別件村約候証民',
            'price' => 150,
            'start_date' => Carbon::today()->format('Y-m-d'),
            'end_date' => null,
            'published' => true,
        ];

        $this->assertEquals($expected, $special->toJsonableArray());
    }
}