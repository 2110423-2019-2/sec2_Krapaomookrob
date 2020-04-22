<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\User;

class calendarTest extends TestCase
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

    /** @test */
    public function only_student_and_tutor_can_access_calendar_page(){
        $this->acting_as_a_student();

        $response = $this->get("/my-calendar")->assertOk();
    }

    // /** @test guest access */
    // public function guest_cannot_access_calendar(){
    //     $response = $this->get("/my-calendar")->assertRedirect("/login");
    // }
}
