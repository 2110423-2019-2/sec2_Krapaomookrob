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

    // /** @test */
    // public function only_student_and_tutor_can_access_calendar_page(){
    //     $this->acting_as_a_student();

    //     $response = $this->get("/my-calendar")->assertOk();
    // }

    // /** @test guest access */
    // public function guest_cannot_access_calendar(){
    //     $response = $this->get("/my-calendar")->assertOk();
    // }

    // /** @test */
    // public function test_case_1_1(){
    //     $this -> acting_as_a_student();
    //     $response = $this->get("/api/search-courses")->assertOk();
    // }

    /** @test */
    public function test_case_7_5(){

        // $validateRequest = 
        // $tutor = $request->input('tutor');
        // $area = json_decode($request->input('area'));
        // $lat = $area->lat;
        // $long = $area->lng;
        // $subjects = $request->input('subject');
        // $days = $request->input('day');
        // $time = $request->input('time');
        // $hour = $request->input('hour');
        // $noClass = $request->input('noClass');
        // $maxPrice = $request->input('maxPrice');

        // $response = $this->get("/api/search-courses",[
        //     'tutor' => 'Ou',
        //     'area' => '[{"lat":13.7384627},{"lng":100.5320458}]',
        //     'subject' => 'Mathematics',
        //     'day' => '',
        //     'time' => '',
        //     'hour' => '',
        //     'noClass' => '1',
        //     'maxPrice' => '100000'
        // ])->dump();

        // $response = $this->json('get','/api/search-courses', ['{
        //     "tutor":"Ou",
        //     "area": "{"lat":"13.7384627", "lng":"100.5320458"}",
        //     "subject":"Mathematics",
        //     "day":"",
        //     "time":"",
        //     "hour":"",
        //     "noClass":"1",
        //     "maxPrice":"100000"
        // }'])->dump();

        $response = $this->json('get','/api/search-courses', '
        {
            tutor: "tutor",
            area: "",
            subject: "this.chooseSubject",
            day: "this.chooseDay",
            time: "this.time",
            hour: "this.hour",
            noClass: "this.noClass",
            maxPrice: "this.maxPrice"
        }
        ')->dump();
    }

}
