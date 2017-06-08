<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_existing_user_may_log_in()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $this->assertFalse(Auth::check());

        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertSessionMissing('errors');
        $response->assertRedirect('/admin');
        $this->assertTrue(Auth::check());
    }

    /**
     *@test
     */
    public function a_logged_in_user_may_log_out()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $response = $this->post('/admin/logout');

        $response->assertSessionMissing('errors');
        $response->assertRedirect('/');

        $this->assertFalse(Auth::check());
    }
}