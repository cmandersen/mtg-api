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

		.controller("PlaneListCtrl", ["$scope", "Plane", "$routeParams", "$location", "$modal", function($scope, Plane, $routeParams, $location, $modal) {

			Array.prototype.chunk = function(chunkSize) {
			    var R = [];
			    for (var i=0; i<this.length; i+=chunkSize)
			        R.push(this.slice(i,i+chunkSize));
			    return R;
			}

			$scope.planeRows;
			$scope.planes = Plane.get(function(planes) {
				$scope.planeRows = planes.chunk(4);
			});

			$scope.$on("planesUpdated", function(evt, planes) {
				$scope.planes = planes;
				$scope.planeRows = planes.chunk(4);
			});

			$scope.selectRandom = function() {
				$scope.$emit("randomPlanes", {});
			};

			$scope.openModal = function(id) {
				for(var index in $scope.planes) {
					var plane = $scope.planes[index];
					if(plane.id == id) {
						$scope.plane = plane;
						$scope.index = index;
					}
				}

				$scope.modal();
			};

			$scope.shift = function(event) {
				if(event.keyIdentifier == "Left") {
					$scope.index--;
					if($scope.index < 0) {
						$scope.index = $scope.planes.length - 1;
					}
				} else if(event.keyIdentifier == "Right") {
					$scope.index++;
					if($scope.index == $scope.planes.length) {
						$scope.index = 0;
					}
				}

				$scope.plane = $scope.planes[$scope.index];

				$scope.modal();
			}

			$scope.modal = function() {
				$modal.open({
					templateUrl: "planeModal.html",
					controller: "PlaneModalCtrl",
					scope: $scope,
				});
			}
		}])

		.controller("PlaneModalCtrl", ["$scope", "$modalInstance", function($scope, $modalInstance) {
			var removeListen = $scope.$on("shift", function(evt, event) {
				removeListen();
				$modalInstance.close();
				$scope.shift(event);
			});
		}]);
});