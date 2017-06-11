<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_guest_user_can_not_register_a_new_user()
    {
        $this->assertFalse(Auth::check());

        $response = $this->post('/admin/users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'superadmin' => true
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('users', ['email' => 'joe@example.com']);
    }

    /**
     *@test
     */
    public function a_logged_in_user_can_register_a_new_user_as_superadmin()
    {
        $user = factory(User::class)->create(['superadmin' => 1]);

        $response = $this->actingAs($user)->post('/admin/users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'superadmin' => true
        ]);

        $response->assertSessionMissing('errors');
        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'superadmin' => 1
        ]);
    }

    /**
     *@test
     */
    public function a_logged_in_user_can_register_a_normal_user()
    {

        $user = factory(User::class)->create(['superadmin' => 1]);

        $response = $this->actingAs($user)->post('/admin/users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionMissing('errors');
        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'superadmin' => 0
        ]);
    }

    /**
     *@test
     */
    public function a_non_superadmin_user_can_not_register_new_users()
    {

        $user = factory(User::class)->create(['superadmin' => 0]);

        $response = $this->actingAs($user)->post('/admin/users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'superadmin' => true
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
        ]);
    }
}