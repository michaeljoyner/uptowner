<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_logged_in_user_may_reset_their_own_password()
    {
        $this->disableExceptionHandling();
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);

        $response = $this->actingAs($user)->post('/admin/users/passwords', [
            'old_password' => 'password',
            'password' => 'new_password',
            'password_confirmation' => 'new_password'
        ]);

        $response->assertStatus(302);
        $response->assertSessionMissing('errors');

        Auth::logout();
        $this->assertFalse(Auth::check(), 'user should be logged out');

        Auth::attempt(['email' => 'joe@example.com', 'password' => 'new_password']);
        $this->assertTrue(Auth::check(), 'user should be logged in');
    }

    /**
     *@test
     */
    public function a_user_needs_their_password_to_reset_to_a_new_one()
    {
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);
        $original_password = $user->password;

        $response = $this->actingAs($user)->post('/admin/users/passwords', [
            'old_password' => 'NOT_CORRECT',
            'password' => 'new_password',
            'password_confirmation' => 'new_password'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('old_password');
        $this->assertEquals($original_password, $user->fresh()->password);
    }
}