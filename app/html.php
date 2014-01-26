<?php
HTML::macro('clever_link', function($route, $text) {	
	if( Request::path() == $route ) {
		$active = "class = 'active'";
	}
	else {
		$active = '';
	}
 	
  	return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
});