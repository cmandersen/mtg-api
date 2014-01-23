define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.cards", [])
		.controller("CardListCtrl", ["$scope", "$resource", "$http", "User", "$base64", "limitToFilter", function($scope, $resource, $http, User, $base64, limitToFilter) {
			// Auth
			//$http.defaults.headers.common.Authorization = "Basic " + $base64.encode(User.getKey() + ":x");
			$scope.loggedin = function() {
				return User.isLoggedIn();
			}
			//$http.get("/AllSets.json").success(function(data) {console.log(data);});
			$scope.cards = [];
			var resource = $resource("/api/v1/cards");

			//fetchItems($scope, resource);
			$scope.cardSearch = function() {
				name = $scope.search;

				resource.query({name: name, limit: 100}, function(data) {
					$scope.cards = data;
				});
			};
		}])
		.controller("CardCtrl", ["$scope", "$resource", "$routeParams", function($scope, $resource, $routeParams) {
			$scope.card = $resource("/api/v1/cards/:id", {id: $routeParams.id}).get(function(data) {
				console.log(data);
			});
		}])
		.controller("PlaneListCtrl", ["$scope", "$resource", "$routeParams", "$location", function($scope, $resource, $routeParams, $location) {

			Array.prototype.chunk = function(chunkSize) {
			    var R = [];
			    for (var i=0; i<this.length; i+=chunkSize)
			        R.push(this.slice(i,i+chunkSize));
			    return R;
			}

			$scope.planeRows;
			$scope.planes = $resource("/api/v1/planes").query(function(data) {
				$scope.planeRows = data.chunk(4);
				console.log($scope.planeRows);
			});

			$scope.selectRandom = function() {
				var rand = $scope.planes[Math.floor(Math.random() * $scope.planes.length)];

				$location.path("/planes/" + rand.id);
			};
		}])
		.controller("PlaneCtrl", ["$scope", "$resource", "$routeParams", function($scope, $resource, $routeParams) {
			$scope.plane = $resource("/api/v1/planes/:id", {id: $routeParams.id}).get(function(data) {
				console.log(data);
			});
		}]);
});