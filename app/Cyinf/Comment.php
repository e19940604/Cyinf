<?php

namespace Cyinf;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "commentdetail";

    protected $guarded = [ 'id' ];

    public function course()
    {
        return $this->belongsTo('Cyinf\Course');
    }

}
