<?php


namespace Tests\Unit\Users;


use App\User;
use Tests\TestCase;

class UsersTest extends TestCase
{
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
}