<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use OrderStatusSeeder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\User;
use App\Payment;
use App\Report;
use Illuminate\Support\Facades\DB;


class loggingTest extends TestCase
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



     /** @test invalid access */
     public function cantAccessLog()
     {
        $this->action_as_a_admin();
        $this->get('/admin/log/0')->assertSeeText('Page 404 NOT FOUND');
        $this->get('/admin/log/7')->assertSeeText('Page 404 NOT FOUND');
     }

     /** @test valid access */
    public function adminAccessLog()
    {
        $this->action_as_a_admin();
        //payment
        $p = Payment::count();
        $response = $this->call('GET','/admin/log/1')->assertStatus(200);
        $this->assertCount($p,Payment::all());
         //report
         $p = Report::count();
         $response2 = $this->get('/admin/log/2');
         $response2->assertStatus(200);
        $this->assertCount($p,Report::all());
        //course
        $p =  DB::table('courses')->count();
        $response3 = $this->get('/admin/log/3');
        $response3->assertStatus(200);
        $this->assertCount($p,DB::table('courses')->get());
        //Postponement
        $p =  DB::table('course_classes')->where('status', 'Postponed')->count();
        $response4 = $this->get('/admin/log/4');
        $response4->assertStatus(200);
        $this->assertCount($p,DB::table('course_classes')->where('status', 'Postponed')->get());
        //admin-attendance
        $p =  DB::table('attendances')->count();
        $response6 = $this->get('/admin/log/6');
        $response6->assertStatus(200);
        $this->assertCount($p,DB::table('attendances')->get());
        //user
        $p =  DB::table('users')->count();
        $response5 = $this->get('/admin/log/5');
        $response5->assertStatus(200);
        $this->assertCount($p,DB::table('users')->get());


    }
    /** @test invalid access */
    public function studentAcessLog()
    {
        $this->acting_as_a_student();
        //payment
        $response = $this->call('GET','/admin/log/1')->assertStatus(403);
         //report
         $response2 = $this->get('/admin/log/2');
         $response2->assertStatus(403);
        //course
        $response3 = $this->get('/admin/log/3');
        $response3->assertStatus(403);
        //Postponement
        $response4 = $this->get('/admin/log/4');
        $response4->assertStatus(403);
        //admin-attendance
        $response6 = $this->get('/admin/log/6');
        $response6->assertStatus(403);
        //user
        $response5 = $this->get('/admin/log/5');
        $response5->assertStatus(403);

    }
    /** @test invalid access */
    public function tutorAcessLog()
    {
        $this->acting_as_a_tutor();
        //payment
        $response = $this->call('GET','/admin/log/1')->assertStatus(403);
         //report
         $response2 = $this->get('/admin/log/2');
         $response2->assertStatus(403);
        //course
        $response3 = $this->get('/admin/log/3');
        $response3->assertStatus(403);
        //Postponement
        $response4 = $this->get('/admin/log/4');
        $response4->assertStatus(403);
        //admin-attendance
        $response6 = $this->get('/admin/log/6');
        $response6->assertStatus(403);
        //user
        $response5 = $this->get('/admin/log/5');
        $response5->assertStatus(403);

    }


}
