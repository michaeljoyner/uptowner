<?php


namespace Tests\Feature\Specials;


use App\Specials\Special;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SpecialsServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function all_specials_can_be_fetched_with_correct_fields()
    {
        $this->disableExceptionHandling();
        factory(Special::class, 10)->create([
            'title' => ['en' => 'TEST SPECIAL', 'zh' => '満版復'],
            'description' => ['en' => 'TEST DESCRIPTION', 'zh' => '永門義会可際査別件村約候証民'],
            'price' => 100,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::parse('+7 days'),
            'published' => true
        ]);

        $response = $this->asLoggedInUser()->json('GET', '/admin/services/specials');
        $response->assertStatus(200);

        $fetched_specials = $response->decodeResponseJson();

        $this->assertCount(10, $fetched_specials);
        collect($fetched_specials)->each(function($special) {
            $this->assertArrayHasKey('image', $special);
            $this->assertArrayHasKey('id', $special);
            $this->assertEquals('TEST SPECIAL', $special['title']);
            $this->assertEquals('満版復', $special['zh_title']);
            $this->assertEquals('TEST DESCRIPTION', $special['description']);
            $this->assertEquals('永門義会可際査別件村約候証民', $special['zh_description']);
            $this->assertEquals(100, $special['price']);
            $this->assertTrue($special['published']);
            $this->assertEquals(Carbon::now()->format('Y-m-d'), $special['start_date']);
            $this->assertEquals(Carbon::parse('+7 days')->format('Y-m-d'), $special['end_date']);
        });
    }
}