<?php

namespace Cyinf;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "commentdetail";

    public function course()
    {
        return $this->belongsTo('Cyinf\Course');
    }
}
