define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.cards", [])
		.controller("CardListCtrl", ["$scope", "API", "User", function($scope, API, User) {
			$scope.loggedin = function() {
				return User.isLoggedIn();
			}

			$scope.cardSearch = function() {
				name = $scope.search;

				API.Cards.query({name: name, limit: 100}, function(data) {
					$scope.cards = data;
				});
			};
		}])

		.controller("CardCtrl", ["$scope", "API", "$routeParams", function($scope, API, $routeParams) {
			$scope.card = API.Cards.get({id: $routeParams.id}, function(data) {
				console.log(data);
			});
		}])

		.controller("PlaneListCtrl", ["$scope", "API", "$routeParams", "$location", function($scope, API, $routeParams, $location) {

			Array.prototype.chunk = function(chunkSize) {
			    var R = [];
			    for (var i=0; i<this.length; i+=chunkSize)
			        R.push(this.slice(i,i+chunkSize));
			    return R;
			}

			$scope.planeRows;
			$scope.planes = API.Planes.query(function(data) {
				$scope.planeRows = data.chunk(4);
			});

			$scope.selectRandom = function() {
				$scope.planes = API.Planes.query({randomize: true}, function(data) {
					$scope.planeRows = data.chunk(4);
				});
			};
		}])

		.controller("PlaneCtrl", ["$scope", "API", "$routeParams", function($scope, API, $routeParams) {
			$scope.plane = API.Planes.get({id: $routeParams.id}, function(data) {
				console.log(data);
			});
		}]);
});