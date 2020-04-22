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

    public function paymentLogAdminTest()
    {
        $this->action_as_a_admin();
        $this->get('/admin/log/1');
        $this->assertCount(0,Payment::all());
       // $response->assertViewHas('Payer id');
        // $res2 = $response->assertEquals('Status',$response['status']);
        // $res3 =$response->assertViewHas('Charge id');
        // $res4 =$response->assertViewHas('Updated at');

    }

    // /** @test  */
    // public function testPaymentLog()
    // {
    //     $this->action_as_a_admin();
    //    // $response1 = $this->call('GET','/admin/log/1');
    //     $this->get('/admin/log/1')->assertSee($factory['updated_at']);
    // }

    //   /** @test  */
    // public function reportLogAdminTest()
    // {
    //     $this->action_as_a_admin();
    //     $response2 = $this->get('/getAllVeritiedReport');
    //     $this->assertDatabaseHas('reports', $response2);
    // }
     /** @test valid access */
    public function adminAcessLog()
    {
        $this->action_as_a_admin();
        //payment
        $response = $this->call('GET','/admin/log/1')->assertStatus(200);
         //report
         $response2 = $this->get('/admin/log/2');
         $response2->assertStatus(200);
        //course
        $response3 = $this->get('/admin/log/3');
        $response3->assertStatus(200);
        //Postponement
        $response4 = $this->get('/admin/log/4');
        $response4->assertStatus(200);
        //admin-attendance
        $response6 = $this->get('/admin/log/6');
        $response6->assertStatus(200);
        //user
        $response5 = $this->get('/admin/log/5');
        $response5->assertStatus(200);

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
