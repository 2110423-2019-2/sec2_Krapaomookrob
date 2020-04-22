<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class DatabaseTast extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function paymentsTest()
    {
        $this->assertDatabaseHas('payments');
    }

    public function advertisementTest()
    {
        $this->assertDatabaseHas('advertisements');
    }

    public function cartTest()
    {
        $this->assertDatabaseHas('carts');
    }


}
