<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;

use App\CourseStudent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event; 
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;

class calendarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();
        Event::fake();
        // Artisan::call('migrate:fresh', ['--env' => 'testing']);
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--env' => 'testing']);
    }

    // fake student user
    private function acting_as_a_student(){
        $this->actingAs(factory(User::class)->create([
            'role' => 'student'
        ]));
    }

    // fake tutor
    private function acting_as_a_tutor(){
        $this->actingAs(factory(User::class)->create([
            'role' => 'tutor'
        ]));
    }

    // fake admin
    private function acting_as_admin(){
        $this->actingAs(factory(User::class)->create([
            'role' => 'admin'
        ]));
    }

    // acting as existing user in database
    private function acting_as_existing_user($role){
        $id = $role=='student' ? 2 : 6;
        $user = User::find($id);
        $this->actingAs($user); 
    }

    /**@test case 1: user student, check calendar postpone a postponaable class */
    public function student_calendar_postpone(){
        $this->acting_as_existing_user('student');

        // test access page
        $response = $this->get('/my-calendar')->assertOk();

        // fetch db
        $course = CourseStudent::where('user_id','=',2)->where('status','=','registered')->first();
        // $class = ;


        // test call api
        $apiResponse = $this->getJson('/api/class/postpone', ['classId'=>'']);

    }


    /** @test */
    public function only_student_and_tutor_can_access_calendar_page(){
        $this->acting_as_a_student();

        $response = $this->get("/my-calendar")->assertOk();
    }

    /** @test guest access */
    public function guest_cannot_access_calendar(){
        $response = $this->get("/my-calendar")->assertRedirect("/login");
    }

    /**@test: try assert */
    public function test_seeder_call(){
        $this->assertDatabaseHas('users', [
            'name' => 'Somying Anaco'
        ]);
    }

    /**@test acting as existing user */
    public function test_acting_as_existing_user(){
        // student
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/cart')->assertOk();
    }
}
