<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event; 
use Tests\TestCase;
use App\User;

class createCourseTest extends TestCase
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

    private function acting_as_a_guest(){
        $this->actingAs(factory(User::class)->create());
    }

    /** @test */
    public function test_case_10_basic(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Mathematics'],
            'days' => ['Wednesday'],
            'time' => '23:00',
            'hours' => '2',
            'startDate' => '2020-05-23',
            'price' => '1500',
            'noClasses' => '1',
            'studentCount' => '3',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(200);
    }

    /** @test */
    public function test_case_10_01(){
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['History'],
            'days' => ['Monday'],
            'time' => '00:00',
            'hours' => '1',
            'startDate' => '2020-05-01',
            'price' => '500',
            'noClasses' => '1',
            'studentCount' => '1',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(401);
        
    }

    /** @test */
    public function test_case_10_02(){
        $this -> acting_as_a_student();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Technology'],
            'days' => ['Tuesday'],
            'time' => '01:00',
            'hours' => '2',
            'startDate' => '2020-05-02',
            'price' => '1000',
            'noClasses' => '1',
            'studentCount' => '2',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(401);
    }

    /** @test */
    public function test_case_10_03(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Technology'],
            'days' => ['Wednesday'],
            'time' => '23:00',
            'hours' => '2',
            'startDate' => '2020-05-30',
            'price' => '1500',
            'noClasses' => '1',
            'studentCount' => '3',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(200);
        $this->assertDatabaseHas('courses',[
            'time' => '23:00',
            'hours' => '2',
            'startDate' => '2020-05-30',
            'price' => '1500'
        ]);
    }

    /** @test */
    public function test_case_10_04(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Taxonomy'],
            'days' => ['Thursday'],
            'time' => '02:00',
            'hours' => '1.5',
            'startDate' => '2020-05-03',
            'price' => '750',
            'noClasses' => '1',
            'studentCount' => '4',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_05(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Mathematics', 'Technology'],
            'days' => ['Thursday'],
            'time' => '02:00',
            'hours' => '2',
            'startDate' => '2020-05-03',
            'price' => '750',
            'noClasses' => '1',
            'studentCount' => '4',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(200);
        $this->assertDatabaseHas('courses',[
            'time' => '02:00',
            'hours' => '2',
            'startDate' => '2020-05-03',
            'price' => '750',
        ]);
    }

    /** @test */
    public function test_case_10_06(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Mathematics', 'Computer Science'],
            'days' => ['Saturday'],
            'time' => '04:00',
            'hours' => '1.25',
            'startDate' => '2020-05-05',
            'price' => '5000',
            'noClasses' => '1',
            'studentCount' => '1',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_07(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => "",
            'days' => ['Sunday'],
            'time' => '05:30',
            'hours' => '1',
            'startDate' => '2020-05-06',
            'price' => '1000',
            'noClasses' => '2',
            'studentCount' => '2',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_08(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Mathematics','Technology'],
            'days' => ['May'],
            'time' => '06:30',
            'hours' => '2',
            'startDate' => '2020-05-07',
            'price' => '100',
            'noClasses' => '0',
            'studentCount' => '3',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }
    /** @test */
    public function test_case_10_09(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Mathematics','Technology'],
            'days' => ['Thursday','Friday'],
            'time' => '07:25',
            'hours' => '3',
            'startDate' => '2020-05-08',
            'price' => '250',
            'noClasses' => '',
            'studentCount' => '4',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_10(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['Mathematics','Technology'],
            'days' => ['Thursday','May'],
            'time' => '09:30',
            'hours' => '2',
            'startDate' => '2020-05-09',
            'price' => '350',
            'noClasses' => '10',
            'studentCount' => '8',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_11(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => [''],
            'time' => '08:15',
            'hours' => '1',
            'startDate' => '2020-05-10',
            'price' => '450',
            'noClasses' => '10',
            'studentCount' => '',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_12(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Monday'],
            'time' => '10000',
            'hours' => '2',
            'startDate' => '2020-05-11',
            'price' => '750',
            'noClasses' => '1',
            'studentCount' => '1',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_13(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Tuesday'],
            'time' => '',
            'hours' => '3',
            'startDate' => '2020-05-12',
            'price' => '610',
            'noClasses' => '1',
            'studentCount' => '2',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_14(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Wednesday'],
            'time' => '07:25',
            'hours' => '3',
            'startDate' => '2020-13-21',
            'price' => '659',
            'noClasses' => '1',
            'studentCount' => '3',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_15(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Thursday'],
            'time' => '08:00',
            'hours' => '2',
            'startDate' => '1999-05-21',
            'price' => '2000',
            'noClasses' => '1',
            'studentCount' => '4',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_16(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Friday'],
            'time' => '09:45',
            'hours' => '2',
            'startDate' => '',
            'price' => '200',
            'noClasses' => '1',
            'studentCount' => '5',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_17(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Friday'],
            'time' => '06:20',
            'hours' => '-2',
            'startDate' => '2020-05-13',
            'price' => '1000',
            'noClasses' => '1',
            'studentCount' => '1',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_18(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Friday'],
            'time' => '06:20',
            'hours' => '0',
            'startDate' => '2020-05-13',
            'price' => '-1000',
            'noClasses' => '1',
            'studentCount' => '2',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_19(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Friday'],
            'time' => '06:20',
            'hours' => '',
            'startDate' => '2020-05-13',
            'price' => '0',
            'noClasses' => '1',
            'studentCount' => '3',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }

    /** @test */
    public function test_case_10_20(){
        $this -> acting_as_a_tutor();
        $response = $this->json('post',"/api/course/new",[
            'subjects' => ['English'],
            'days' => ['Friday'],
            'time' => '06:20',
            'hours' => '0.5',
            'startDate' => '2020-05-13',
            'price' => '',
            'noClasses' => '1',
            'studentCount' => '4',

            'locationId' => '1',
            'area' => 'Siam',
            'address' => 'Bangkok',
            'center' => [
                'lat' => '20.00',
                'lng' => '50.00'
            ],
        ])->assertStatus(422);
    }
    

}
