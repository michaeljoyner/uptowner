<?php


namespace Tests\Feature\Specials;


use App\Specials\Special;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ClearSpecialDatesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_specials_dates_can_be_cleared()
    {
        $special = factory(Special::class)->create([
            'start_date' => Carbon::today()->format('Y-m-d'),
            'end_date' => Carbon::parse('+5 days')->format('Y-m-d')
        ]);

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/specials/' . $special->id . '/dated');
        $response->assertStatus(200);

        $this->assertDatabaseHas('specials', [
            'id' => $special->id,
            'start_date' => null,
            'end_date' => null
        ]);
    }
}