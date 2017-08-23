<?php


namespace Tests\Feature\Specials;


use App\Specials\Special;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SpecialsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_special_can_be_created()
    {
        $this->disableExceptionHandling();
        $special_attributes = [
            'title' => 'Buy one get one free',
            'zh_title' => 'Mei yi song yi',
            'description' => 'One free burger with every burger meal',
            'zh_description' => 'Yige songde hambao',
            'price' => 300,
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::parse('+7 days')->format('Y-m-d')
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/specials', $special_attributes);
        $response->assertStatus(200);

        $expected_attributes = collect($special_attributes)->reject(function($value, $attribute) {
            return str_contains($attribute, '_date');
        })->toArray();
        $this->assertTranslatableTableHas('specials', $expected_attributes);

        $this->assertCount(1, Special::all());
        $special = Special::first();

        $this->assertTrue($special->start_date->isToday());
        $this->assertTrue($special->end_date->subDays(7)->isToday());
    }

    /**
     *@test
     */
    public function a_special_can_be_created_with_a_long_form_time_string_as_a_start_date()
    {
        $this->disableExceptionHandling();
        $special_attributes = [
            'title' => 'Buy one get one free',
            'zh_title' => 'Mei yi song yi',
            'description' => 'One free burger with every burger meal',
            'zh_description' => 'Yige songde hambao',
            'price' => 300,
            'start_date' => Carbon::today()->format('Y-m-d') . 'T00:00:00.000Z',
            'end_date' => Carbon::parse('+7 days')->format('Y-m-d')
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/specials', $special_attributes);
        $response->assertStatus(200);

        $expected_attributes = collect($special_attributes)->reject(function($value, $attribute) {
            return str_contains($attribute, '_date');
        })->toArray();
        $this->assertTranslatableTableHas('specials', $expected_attributes);

        $this->assertCount(1, Special::all());
        $special = Special::first();

        $this->assertTrue($special->start_date->isToday());
        $this->assertTrue($special->end_date->subDays(7)->isToday());
    }

    /**
     *@test
     */
    public function a_special_can_be_created_with_a_long_form_time_string_as_an_end_date()
    {
        $this->disableExceptionHandling();
        $special_attributes = [
            'title' => 'Buy one get one free',
            'zh_title' => 'Mei yi song yi',
            'description' => 'One free burger with every burger meal',
            'zh_description' => 'Yige songde hambao',
            'price' => 300,
            'start_date' => Carbon::today()->format('Y-m-d'),
            'end_date' => Carbon::parse('+7 days')->format('Y-m-d') . 'T00:00:00.000Z'
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/specials', $special_attributes);
        $response->assertStatus(200);

        $expected_attributes = collect($special_attributes)->reject(function($value, $attribute) {
            return str_contains($attribute, '_date');
        })->toArray();
        $this->assertTranslatableTableHas('specials', $expected_attributes);

        $this->assertCount(1, Special::all());
        $special = Special::first();

        $this->assertTrue($special->start_date->isToday());
        $this->assertTrue($special->end_date->subDays(7)->isToday());
    }

    /**
     *@test
     */
    public function a_special_can_be_updated()
    {
        $this->disableExceptionHandling();

        $special = factory(Special::class)->create();
        $update_data = [
            'title' => '20% off all hashbrowns',
            'zh_description' => 'Yu would not believe it',
            'end_date' => Carbon::parse('+3 days')->format('Y-m-d')
        ];
        $expected_data = [
            'title' => '20% off all hashbrowns',
            'zh_title' => $special->getTranslation('title', 'zh'),
            'description' => $special->getTranslation('description', 'en'),
            'zh_description' => 'Yu would not believe it',
            'price' => $special->price
        ];

        $response = $this->asLoggedInUser()->json('POST', '/admin/specials/' . $special->id, $update_data);
        $response->assertStatus(200);

        $this->assertTranslatableTableHas('specials', $expected_data);

        $this->assertCount(1, Special::all());
        $special = Special::first();

        $this->assertTrue($special->start_date->isToday());
        $this->assertTrue($special->end_date->subDays(3)->isToday());

    }

    /**
     *@test
     */
    public function updating_a_special_responds_with_correct_data_structure()
    {
        $this->disableExceptionHandling();

        $special = factory(Special::class)->create();
        $update_data = [
            'title' => '20% off all hashbrowns',
            'zh_description' => 'Yu would not believe it',
            'end_date' => Carbon::parse('+3 days')->format('Y-m-d')
        ];


        $response = $this->asLoggedInUser()->json('POST', '/admin/specials/' . $special->id, $update_data);
        $response->assertStatus(200);

        $returned_data = $response->decodeResponseJson();
        $freshSpecial = $special->fresh();

        $this->assertEquals($returned_data, $freshSpecial->toJsonableArray());

    }

    /**
     *@test
     */
    public function a_special_can_be_deleted()
    {
        $this->disableExceptionHandling();
        $special = factory(Special::class)->create();

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/specials/' . $special->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('specials', ['id' => $special->id]);
    }
}