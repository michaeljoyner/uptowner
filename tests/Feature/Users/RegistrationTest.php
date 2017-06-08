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
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect('/admin/login');

        $this->assertDatabaseMissing('users', ['email' => 'joe@example.com']);
    }

    /**
     *@test
     */
    public function a_logged_in_user_can_register_a_new_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/admin/users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionMissing('errors');
        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com'
        ]);
    }
}