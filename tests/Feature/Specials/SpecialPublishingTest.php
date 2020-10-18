<?php


namespace Tests\Feature\Specials;


use App\Specials\Special;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SpecialPublishingTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_unpublished_special_is_correctly_published()
    {
        $this->disableExceptionHandling();
        $special = factory(Special::class)->create(['published' => false]);

        $response = $this
            ->asLoggedInUser()
            ->json('POST', '/admin/specials/' . $special->id . '/publish', ['publish' => true]);
        $response->assertStatus(200);

        $this->assertEquals(['new_status' => true], $response->json());

        $this->assertTrue($special->fresh()->published);
    }
}