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
        'name', 'email', 'password', 'nickname', 'phone', 'image', 'role', 'is_suspended', 'education_level', 'balance'
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

    public function getImage(){
        return $this->image;
    }

    public function getSecret(){
        return str_repeat("*",strlen($this -> password));
    }

    public function registeredCourses(){
        return $this->belongsToMany('App\Course', 'course_student')->withTimestamps();
    }

    public function notifications() {
        return $this->belongsToMany(Notification::class);
    }

    public function requestPaymentRequests(){
        return $this->hasMany('App\PaymentRequest', 'requested_by');
    }

    public function Report(){
        return $this->hasMany(Report::class);
    }

    public function classes()
    {
        return $this->hasManyThrough('App\CourseClass', 'App\Course');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    
    public function transactions() {
        return $this->belongsToMany(Transaction::class);
    }

    public function courseRequests(){
        return $this->belongsToMany(CourseRequester::class);
    }

    public function advertisements() {
        return $this->belongsToMany(Advertisement::class);
    }

    public function banner(){
        return $this->hasOne(Banner::class);
    }
}
