<?php

namespace Cyinf\Presenters;

use \Auth;

class SidebarPresenter
{
	
	public function viewLogInOrOut(){
		if(Auth::guard('web')->check()){
			return '<li><a class="dr-icon dr-icon-switch" href="/users/logout">&nbsp;&nbsp;&nbsp;Logout</a></li>';
		}
		else{
			return '<li><a class="dr-icon dr-icon-switch" href="/users/login">&nbsp;&nbsp;&nbsp;Login</a></li>';
		}
	}
}