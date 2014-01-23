<?php

User::creating(function($user) {
	$user->api_key = User::createApiKey();
});