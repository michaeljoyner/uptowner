<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_user_can_be_deleted()
    {
        $admin = factory(User::class)->create(['superadmin' => true]);
        $user = factory(User::class)->create();

        $response = $this->actingAs($admin)->delete('/admin/users/' . $user->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     *@test
     */
    public function a_non_super_admin_cannot_delete_a_user()
    {
        $admin = factory(User::class)->create(['superadmin' => false]);
        $user = factory(User::class)->create();

        $response = $this->actingAs($admin)->delete('/admin/users/' . $user->id);
        $response->assertStatus(403);

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /**
     *@test
     */
    public function a_guest_cannot_delete_a_user()
    {
        $user = factory(User::class)->create();
        $this->assertFalse(Auth::check());

        $response = $this->json('DELETE', '/admin/users/' . $user->id);
        $response->assertStatus(401);

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}