<?php

namespace Cyinf;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "coursedetail";

    public function comments()
    {
        return $this->hasMany('Cyinf\Comment');
    }
}
