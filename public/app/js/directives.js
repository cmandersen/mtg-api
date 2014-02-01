define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.directives", [])
		.directive('ngShift', ["$rootScope", function($rootScope) {
			return function(scope, element, attrs) {
				element.bind("keydown keypress", function(event) {
					if(event.keyCode == 37 || event.keyCode == 39)
						$rootScope.$broadcast("shift", event);
				});
			};
		}]);
});