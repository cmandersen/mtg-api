define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.users", [])
		.controller("UserLoginCtrl", ["$scope", "$http", "$location", "User", function($scope, $http, $location, User) {
			$scope.messageType = "";
			$scope.message = "";

			$scope.login = function() {
				$http.post("/api/v1/login", {'username': $scope.username, 'password': $scope.password}).success(function(response) {
					$scope.messageType = "success";
					$scope.message = "Logged in successfully";
					User.setUser(response.user);
					$location.path("/").replace();
				}).error(function(response) {
					$scope.messageType = "danger";
					$scope.message = response.message;
				});
			}
		}]);
});