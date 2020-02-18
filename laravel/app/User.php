<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nickname', 'phone', 'image', 'role', 'is_suspended', 'education_level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isTutor(){
        return $this->role == 'tutor';
    }

    public function isStudent(){
        return $this->role == 'student';
    }

    public function isAdmin(){
        return $this->role == 'admin';
    }

    public function isSuperuser(){
        return $this->role == 'superuser';
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function BankAccount(){
        return $this->hasOne('App\BankAccount');
    }

    public function registeredCourses(){
        return $this->belongsToMany('App\Course', 'course_student');
    }
}
