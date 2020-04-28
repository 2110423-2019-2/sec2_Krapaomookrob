<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;
use laravel\BrowserKitTesting\Concerns\InteractsWithPages;
use laravel\BrowserKitTesting\HttpException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\User;
use App\Payment;
use Illuminate\Foundation\Testing\TestResponse;


class adsTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void{
        parent::setUp();
        Event::fake();
    }

    private function acting_as_a_student(){
        $this->actingAs(factory(User::class)->create([
            'role' => 'student'
        ]));
    }

    private function acting_as_a_tutor(){
        $this->actingAs(factory(User::class)->create([
            'role' => 'tutor'
        ]));
    }

    private function action_as_a_admin(){
        $this->actingAs(factory(User::class)->create([
            'role' => 'admin'
        ]));
    }

    /** @test guest view */
    public function guestAdsTest()
    {
        $this->get('/create-advertisement')->assertStatus(302);
    }

    /** @test tutor go to cart view */
    public function tutorAdsTest()
    {
        $this->acting_as_a_tutor();
        $this->get('/create-advertisement')->assertStatus(200);
    }

    /** @test tutor cant transfer by himself */
    public function studentAdsTest()
    {
        $this->acting_as_a_student();
        $this->get('/create-advertisement')->assertStatus(403);
    }

    public function adminAdsTest()
    {
        $this->action_as_a_admin();
        $this->get('/create-advertisement')->assertStatus(403);
    }


}
