<?php

namespace Cyinf;

use Illuminate\Database\Eloquent\Model;

class Password_resets extends Model
{	
	protected $primaryKey = 'token';

    public $incrementing = false;

    public $timestamps = false;
}
