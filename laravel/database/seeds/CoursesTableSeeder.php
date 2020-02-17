<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Day;
use App\Subject;
use App\Location;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
          foreach($days as $day){
              Day::create([
                'name' => $day,
              ]);
          }

          $subjects = ['Mathematics ', 'Economic', 'History', 'Technology', 'Science', 'Biology', 'Chemical', 'English', 'Thai', 'Geography', 'Physics', 'Music'];
          foreach($subjects as $subject){
              Subject::create([
                'name' => $subject,
              ]);
          }

          $location = Location::create([
            'name' => 'จุฬาลงกรณ์มหาวิทยาลัย',
            'address' => '254 ถนน พญาไท แขวง วังใหม่ เขตปทุมวัน กรุงเทพมหานคร 10330 ประเทศไทย',
            'locationId' => '5a14febeeeafb68572c007e2fc69ea6f2a609651'
          ]);

          $course = Course::create([
            'time' => '12:00:00',
            'hours' => '2',
            'startDate' => '2020-02-04',
            'studentCount' => 3,
            'price' => 500,
            'noClasses' => '5',
            'user_id' => 1,
            'location_id' => 1
          ]);

          $someDays = Day::find([1,2,3]);
          $someSubjects = Subject::find([1,2,3]);

          $course->days()->attach($someDays);
          $course->subjects()->attach($someSubjects);

          $course2 = Course::create([
            'time' => '14:00:00',
            'hours' => '2',
            'startDate' => '2020-02-04',
            'studentCount' => 3,
            'price' => 1000,
            'noClasses' => '4',
            'user_id' => 1,
            'location_id' => 1
          ]);

          $someDays2 = Day::find([2,4]);
          $someSubjects2 = Subject::find([1,2,3]);

          $course2->days()->attach($someDays2);
          $course2->subjects()->attach($someSubjects2);


    }
}
