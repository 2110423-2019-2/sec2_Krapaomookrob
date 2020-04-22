<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event; 
use Tests\TestCase;
use App\User;

class searchTest extends TestCase
{
    //use RefreshDatabase;

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

    private function acting_as_a_guest(){
        $this->actingAs(factory(User::class)->create());
    }

    /** @test */
    public function test_case_1_1(){
        $this -> acting_as_a_tutor();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "Somry Reswaeq",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Mathematics'],
            'day' => ['Sunday'],
            'time' => '12:00',
            'hour' => [''],
            'noClass' => '5',
            'maxPrice' => '1000'
        ])->assertUnauthorized();
    }

    /** @test */
    public function test_case_1_2(){
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "Somry Reswaeq",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Mathematics'],
            'day' => ['Sunday'],
            'time' => '12:00',
            'hour' => [''],
            'noClass' => '5',
            'maxPrice' => '1000'
        ])->assertUnauthorized();
    }

    /** @test */
    public function test_case_1_3(){
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "Krit Kruaykitanon",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Economic'],
            'day' => ['Sunday'],
            'time' => '14:00',
            'hour' => [''],
            'noClass' => '10',
            'maxPrice' => '500'
        ])->assertUnauthorized();
    }

    /** @test */
    public function test_case_1_4(){
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Mathematics'],
            'day' => ['Monday'],
            'time' => '9:30',
            'hour' => [''],
            'noClass' => '3',
            'maxPrice' => '750'
        ])->assertUnauthorized();
    }

    /** @test */
    public function test_case_1_5(){
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "Somry Reswaeq",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Computer Science'],
            'day' => [''],
            'time' => '15:00',
            'hour' => ['2'],
            'noClass' => '2',
            'maxPrice' => '1200'
        ])->assertUnauthorized();
    }

    /** @test */
    public function test_case_1_6(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "Somry Reswaeq",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Mathematics'],
            'day' => [''],
            'time' => '12:00',
            'hour' => ['2'],
            'noClass' => '5',
            'maxPrice' => '1000'
        ])->assertOk();
    }

    /** @test */
    public function test_case_1_7(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "Somry Reswaeq",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => [''],
            'time' => '08:00',
            'hour' => ['1'],
            'noClass' => '2',
            'maxPrice' => '500'
        ])->assertOk();
    }

    /** @test */
    public function test_case_1_8(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => ['Sunday'],
            'time' => '12:00',
            'hour' => ['2'],
            'noClass' => '5',
            'maxPrice' => '1000'
        ])->assertOk();
    }

    /** @test */
    public function test_case_1_9(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['History'],
            'day' => ['Friday'],
            'time' => '',
            'hour' => ['2'],
            'noClass' => '5',
            'maxPrice' => '1000'
        ])->assertOk();
    }

    /** @test */
    public function test_case_1_10(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['History','Computer'],
            'day' => ['Friday'],
            'time' => '',
            'hour' => ['2'],
            'noClass' => '5',
            'maxPrice' => '1000'
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_11(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => ['May'],
            'time' => '',
            'hour' => [''],
            'noClass' => '20',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_12(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => ['May', 'Sunday'],
            'time' => '09:30',
            'hour' => [''],
            'noClass' => '40',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_13(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => [''],
            'time' => '-30000',
            'hour' => [''],
            'noClass' => '',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_14(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => [''],
            'time' => '9:30',
            'hour' => ['0'],
            'noClass' => '',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_15(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => [''],
            'time' => '9:30',
            'hour' => ['-5'],
            'noClass' => '',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_16(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => [''],
            'day' => ['Saturday'],
            'time' => '23:30',
            'hour' => ['2'],
            'noClass' => '',
            'maxPrice' => ''
        ])->assertOk();
    }
    
    /** @test */
    public function test_case_1_17(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Geography', 'History'],
            'day' => [''],
            'time' => '',
            'hour' => [''],
            'noClass' => '0',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_18(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Physics', 'Mathematics', 'Technology'],
            'day' => [''],
            'time' => '',
            'hour' => ['2'],
            'noClass' => '-10',
            'maxPrice' => ''
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_19(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['Music','Economic'],
            'day' => [''],
            'time' => '',
            'hour' => ['2'],
            'noClass' => '',
            'maxPrice' => '-500'
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_1_20(){
        $this->acting_as_a_student();
        $response = $this->json('get',"/api/search-courses",[
            'tutor' => "",
            'area' => '[{"lat":"13.7384627","lng":"100.5320458"}]',
            'subject' => ['English', 'Thai'],
            'day' => [''],
            'time' => '',
            'hour' => ['2'],
            'noClass' => '',
            'maxPrice' => '0'
        ])->assertOk();
    }

}
