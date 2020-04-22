<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\User;
use App\Payment;
use Illuminate\Foundation\Testing\TestResponse;

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
     /** @test student add to cart */
    public function studentAddToCartTest()
    {
        $this->acting_as_a_student();
        $this->get('/api/cart/add', ['course_id' => 2]);
        $this->get('/api/cart/add', ['course_id' => 1]);
        $this->get('/cart')->assertStatus(200);

       // $response = $this->get('/api/getPayment')->assertOK();
      //  $this->assertEquals($response.data,['payment_id'=>'1','totalprice'=> '1500']);
       // $this->get(sprintf('/payment/%s/%s',$response.data.payment_id,$response.data.totalprice))->assertStatus(200);
    }

    public function tutorAddToCartTest()
    {
        $this->acting_as_a_tutor();

    }
    // public function testBasicTest()
    // {

    //     $user = factory(App\Http\Controllers\Auth\LoginController::class)->loginDeveloper(1);

    //     // test1 course duplicate
    //     $cart = factory(App\Http\Controllers\CartController::class)->addToCart([
    //         'course_id' => '5',
    //     ]);

    //     $this->assertEquals(200, );
    //     //
    // }


}
