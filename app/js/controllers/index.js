define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.index", [])
		.controller("IndexCtrl", ["$scope", "User", function($scope, User) {
			$scope.loggedin = function() {
				return User.isLoggedIn();
			};

			$scope.isAdmin = function() {
				return User.isAdmin();
			},

			$scope.logout = function() {
				User.logout();
			};
		}]);
});