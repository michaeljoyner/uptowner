<?php


namespace Tests\Unit\Users;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_user_can_be_a_superadmin()
    {
        $super = factory(User::class)->make(['superadmin' => 1]);
        $regular = factory(User::class)->make(['superadmin' => 0]);

        $this->assertTrue($super->isSuperadmin());
        $this->assertFalse($regular->isSuperadmin());
    }

    /**
     *@test
     */
    public function a_users_password_can_be_reset()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $user->resetPassword('new_password');

        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));

    }
}