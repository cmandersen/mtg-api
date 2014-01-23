define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.update", [])
		.controller("UpdateCtrl", ["$scope", "$http", function($scope, $http) {
			$scope.working = true;
			$http.get("/api/v1/update").success(function(response) {
				console.log(response);
				$scope.working = false;
			}).error(function(response) {
				console.log(response);
				$scope.working = false;
			});
		}]);
});