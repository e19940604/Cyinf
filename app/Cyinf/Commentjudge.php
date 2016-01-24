<?php

namespace Cyinf;

use Illuminate\Database\Eloquent\Model;

class Commentjudge extends Model
{
    protected $table = 'commentjudge';

    public function comment(){
    	return $this->belongsTo('Cyinf\Comment');
    }
}
