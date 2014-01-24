define([
	"angular",
	"angularRoute",
	"angularResource",
	"angularCookies",
	"bootstrap",
	"directives",
	"services",
	"controllers/index",
	"controllers/dashboard",
	"controllers/cards",
	"controllers/users",
	"controllers/update",
	"nappMenu",
	"base64"
], function() {
	'use strict';

	return angular.module('mtg', [
		"ngRoute",
		"ngResource",
		"ngCookies",
		"ui.bootstrap",
		"mtg.directives",
		"mtg.services",
		"mtg.controllers.index",
		"mtg.controllers.dashboard",
		"mtg.controllers.cards",
		"mtg.controllers.users",
		"mtg.controllers.update",
		"napp.menu",
		"base64"
	]);
});