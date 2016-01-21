<?php

namespace Cyinf\Services;

use \Mail;

class EmailService 
{
	public function sendRegisterMail($usermail, $username, $thecode){
		$link = url('users/auth?code='.$thecode);

		/*
		|--------------------------------------------------------------------------
		| If mail not work
		|--------------------------------------------------------------------------
		|
		| 1. Check mail setting then using Mail::send function to test.
		| 2. Check redis install and start.
		| 3. Check package predis/predis install.
		| 4. Check queue(redis) setting.
		| 5. Check laravel queue listen start, if not using below command to start listen.
		|    [ php artisan queue:work redis --daemon --sleep=3 --tries=3 ]
		|
		*/

		Mail::queue(
			'emails.RegisterEmail',
			['username' => $username, 'link' => $link],
			function ($message) use($usermail) {
				$message->to($usermail)->subject('Facing Course Authentication');
			}
		);
	}
}