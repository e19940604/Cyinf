<?php

namespace Cyinf;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "student";

    protected $primaryKey = 'stu_id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'passwd', 'FB_conn'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'passwd', 'remember_token',
    ];

    public function courses(){
        return $this->belongsToMany( 'Cyinf\Course' , "favoritescourse" , 'course_id', 'stu_id' );
    }
}
