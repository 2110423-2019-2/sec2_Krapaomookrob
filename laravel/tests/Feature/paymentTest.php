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
use Illuminate\Foundation\Testing\TestResponse;

use App\Payment;
use App\course;
use App\Cart;
use App\User;
use App\CourseStudent;
use App\PaymentRequest;
use App\BankAccount;
use App\CourseRequester;
use App\OmiseRecipientAccount;
use App\RefundRequest;

class paymentTest extends TestCase
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

    private function create_course(){
        $user = factory(course::class,3)->create();

    }

    private function register_course($no){
        factory(CourseStudent::class)->create([
            'course_id' => '1',
            'status' => 'registered'
        ]);
    }


  /** @test guest view */
  public function guestPaymentTest()
  {
      $this->get('/cart')->assertStatus(302);
      $this->post('/transfer')->assertStatus(302);
      $this->get('/payment')->assertStatus(302);
  }

  /** @test tutor go to cart view */
  public function tutorCartTest()
  {
      $this->acting_as_a_tutor();
      $this->get('/cart')->assertStatus(403);
  }

  /** @test tutor cant transfer by himself */
  public function tutorTransferTest()
  {
      $this->acting_as_a_tutor();
      $this->post('/transfer')->assertStatus(403);
  }


  /** @test student cant transfer by himself */
  public function studentTransferTest()
  {
      $this->acting_as_a_student();
      $this->post('/transfer')->assertStatus(403);
  }

   /** @test tutor go to cart view */
   public function adminCartTest()
   {
      $this->action_as_a_admin();
       $this->get('/cart')->assertStatus(403);
   }




}
