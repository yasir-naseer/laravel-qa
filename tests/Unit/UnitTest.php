<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class UnitTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() : void{
        parent::setUp();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_user_has_name_attribute()
    {
        $user = factory(User::class)->make();
        $this->assertNotEmpty($user->name);

    }
}
