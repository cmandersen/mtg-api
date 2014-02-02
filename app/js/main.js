require.config({
	paths: {
		angular: "//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.min",
		angularRoute: "//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.min",
		angularResource: "//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-resource.min",
		angularCookies: "//ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-cookies.min",
		bootstrap: "app/lib/bootstrap/ui-bootstrap-custom-0.9.0.min",
		nappMenu: "app/lib/napp-menu/js/rq-angular-napp-menu",
		base64: "app/lib/base64",
	},
	shim: {
		"angular": {
			"exports": "angular"
		},
		"angularRoute": ["angular"],
		"angularResource": ["angular"],
		"angularCookies": ["angular"],
		"bootstrap": ['angular'],
		"nappMenu": ["angular"],
		"base64": ["angular"],
	},
	priority: [
		"angular"
	]
});

//http://code.angularjs.org/1.2.1/docs/guide/bootstrap#overview_deferred-bootstrap
window.name = "NG_DEFER_BOOTSTRAP!";

require([
	'angular',
	'app',
	'routes'
], function(angular, app) {
	'use strict';
	var $html = angular.element(document.getElementsByTagName('html')[0]);

	angular.element().ready(function() {
		angular.resumeBootstrap([app['name']]);
	});
});