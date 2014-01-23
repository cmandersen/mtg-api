define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.dashboard", [])
		.controller("DashCtrl", ["$scope", "User", function($scope, User) {
			$scope.loggedin = function() {
				return User.isLoggedIn();
			}
		}]);
});