<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UsersServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_list_of_users_can_be_retrieved()
    {
        $this->disableExceptionHandling();
        factory(User::class, 5)->create();
        $admin = factory(User::class)->create(['superadmin' => true]);

        $response = $this->actingAs($admin)->json('GET', '/admin/services/users');
        $response->assertStatus(200);

        $data = $response->json();

        $this->assertCount(6, $data);
        $this->assertEquals(collect($data)->pluck('name')->toArray(), User::pluck('name')->toArray());
    }
}