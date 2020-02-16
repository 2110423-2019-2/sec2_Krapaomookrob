<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Day;
use App\Subject;
use App\User;

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
            'noClasses' => '10',
            'user_id' => 1
          ]);

          $someDays = Day::find([1,2,3]);
          $someSubjects = Subject::find([1,2,3]);

          $course->days()->attach($someDays);
          $course->subjects()->attach($someSubjects);

          $course2 = Course::create([
            'area' => 'Silom',
            'time' => '14:00:00',
            'hours' => '2',
            'startDate' => '2020-02-04',
            'studentCount' => 3,
            'price' => 1000,
            'noClasses' => '6',
            'user_id' => 2
          ]);

          $someDays2 = Day::find([2,4]);
          $someSubjects2 = Subject::find([1,2,3]);
          
          $course2->days()->attach($someDays2);
          $course2->subjects()->attach($someSubjects2);

          for($i = 1; $i <= 27; $i++){
            $courseI = Course::create([
              'area' => 'Silom',
              'time' => '14:00:00',
              'hours' => '2',
              'startDate' => '2020-02-'.$i,
              'studentCount' => 3,
              'price' => 1000*($i%3) + ($i%13)*100,
              'noClasses' => $i,
              'user_id' => $i%2==0?5:6
            ]);

            $someDaysI = $courseI->days()->attach(Day::find([$i%8, ($i+1)%8, ($i+2)%8]));
            $someSubjectsI = $courseI->subjects()->attach(Subject::find([$i%13, $i%3, $i%5]));
            
            $courseI->days()->attach($someDaysI);
            $courseI->subjects()->attach($someSubjectsI);

            $courseI->students()->attach(User::find($i % 6 + 1));
          }
      

    }
}
