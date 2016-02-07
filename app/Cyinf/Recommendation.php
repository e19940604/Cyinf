<?php

namespace Cyinf;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{	
	protected $primaryKey = 'recommendation';

    public $incrementing = false;

    public $timestamps = false;
}
