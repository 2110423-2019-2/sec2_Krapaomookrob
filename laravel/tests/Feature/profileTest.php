<?php

namespace Tests\Feature;

// use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event; 
use Tests\TestCase;
use App\User;

class profileTest extends TestCase
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
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon'
        ]));
    }

    private function acting_as_a_guest(){
        $this->actingAs(factory(User::class)->create());
    }

    /** @test */
    public function test_case_7_01(){
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/login");
    }

    /** @test */
    public function test_case_7_02(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('bank_accounts',[
            'account_number' => '0408047552'
        ]);
    }

    /** @test */
    public function test_case_7_03(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('users',[
            'role' => 'tutor'
        ]);
    }

    /** @test */
    public function test_case_7_04(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('users',[
            'role' => 'student'
        ]);
    }

    /** @test */
    public function test_case_7_05(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('users',[
            'role' => 'student'
        ]);
    }

    /** @test */
    public function test_case_7_06(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => null,
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }

    /** @test */
    public function test_case_7_07(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'teacher',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }
   
    /** @test */
    public function test_case_7_08(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Pegasus007',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }

    /** @test */
    public function test_case_7_09(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => '',
            'phone' => '085330102A',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }

    /** @test */
    public function test_case_7_10(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301021A',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }

    /** @test */
    public function test_case_7_11(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '085',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }

    /** @test */
    public function test_case_7_12(){
        $this -> acting_as_a_student();
        $response = $this->call('patch',"/profile",[
            'role' => 'student',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '1234567890',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users',[
            'name' => 'Krit Kruaykitanon'
        ]);
    }

    /** @test */
    public function test_case_7_13(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertStatus(302);
        $this->assertDatabaseHas('users',[
            'phone' => null
        ]);
    }

    /** @test */
    public function test_case_7_14(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'Kindergarten',
            'account_number' => '0408047552',
            'account_name' => 'KritKruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('users',[
            'education_level' => 'Kindergarten',
        ]);
    }

    /** @test */
    public function test_case_7_15(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => '',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('users',[
            'phone' => '0853301020'
        ]);
    }

    /** @test */
    public function test_case_7_16(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '555555a',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseMissing('bank_accounts',[
            'account_number' => '555555a'
        ]);
    }

    /** @test */
    public function test_case_7_17(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('bank_accounts',[
            'account_number' => null
        ]);
    }

    /** @test */
    public function test_case_7_18(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Peter101',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseMissing('bank_accounts',[
            'account_name' => 'Peter101'
        ]);
    }

    /** @test */
    public function test_case_7_19(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => '',
            'bank' => 'Kbank',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('bank_accounts',[
            'account_name' => null
        ]);
    }

    /** @test */
    public function test_case_7_20(){
        $this -> acting_as_a_tutor();
        $response = $this->call('patch',"/profile",[
            'role' => 'tutor',
            'name' => 'Krit Kruaykitanon',
            'nickname' => 'Ou',
            'phone' => '0853301020',
            'education_level' => 'BSc',
            'account_number' => '0408047552',
            'account_name' => 'Krit Kruaykitanon',
            'bank' => 'Bank of Fish',
        ])->assertRedirect("/profile");
        $this->assertDatabaseHas('bank_accounts',[
            'bank' => 'Bank of Fish'
        ]);
    }

}
