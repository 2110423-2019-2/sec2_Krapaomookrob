<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Day;
use App\Subject;

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

          $course = Course::create([
            'area' => 'Siamparagon',
            'time' => '12:00:00',
            'hours' => '2',
            'startDate' => '2020-02-04',
            'studentCount' => 3,
            'price' => 500,
            'noClasses' => '2110865',
            'user_id' => 1
          ]);

          $someDays = Day::find([1,2,3]);
          $someSubjects = Subject::find([1,2,3]);

          $course->days()->attach($someDays);
          $course->subjects()->attach($someSubjects);
    }
}
