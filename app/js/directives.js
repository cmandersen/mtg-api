define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.directives", [])
		.directive('ngShift', ["$rootScope", function($rootScope) {
			return function(scope, element, attrs) {
				element.bind("keydown keypress", function(event) {
					console.log("Event fired");
					$rootScope.$broadcast("shift", event);
				});
			};
		}]);
});