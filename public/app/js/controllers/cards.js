define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.controllers.cards", [])
		.controller("CardListCtrl", ["$scope", "API", "User", "$modal", function($scope, API, User, $modal) {
			$scope.type = "Type";
			$scope.colors = "Color";
			$scope.rarity = 'Rarity';
			$scope.loaded = false;

			$scope.step = 48;

			$scope.limit = 48;

			$scope.loggedin = function() {
				return User.isLoggedIn();
			}

			$scope.$on('cardsUpdated', function(evt, cards) {
				if(cards.length < $scope.limit) {
					$scope.loaded = false;
				} else {
					$scope.loaded = true;
				}
				
				$scope.cards = cards;
				$scope.cardRows = cards.chunk(4);
			});

			$scope.filterType = function(des) {
				$scope.type = des;
				API.Cards.query({limit: $scope.limit, begins: $scope.search, type: $scope.type, colors: $scope.colors, rarity: $scope.rarity}, updateCards);
			};

			$scope.filterColors = function(color) {
				$scope.colors = color;
				API.Cards.query({limit: $scope.limit, begins: $scope.search, type: $scope.type, colors: $scope.colors, rarity: $scope.rarity}, updateCards);
			};

			$scope.filterRarity = function(rar) {
				$scope.rarity = rar;
				API.Cards.query({limit: $scope.limit, begins: $scope.search, type: $scope.type, colors: $scope.colors, rarity: $scope.rarity}, updateCards);
			};

			$scope.cardSearch = function() {
				name = $scope.search;

				API.Cards.query({limit: $scope.limit, begins: name, type: $scope.type, colors: $scope.colors, rarity: $scope.rarity}, updateCards);
			};

			$scope.openModal = function(id) {
				for(var index in $scope.cards) {
					var card = $scope.cards[index];
					if(card.id == id) {
						$scope.card = card;
						$scope.index = index;
					}
				}

				$scope.modal();
			};

			$scope.modal = function() {
				$modal.open({
					templateUrl: "cardModal.html",
					controller: "CardModalCtrl",
					scope: $scope,
				});
			}

			$scope.loadNextBatch = function() {
				$scope.limit += $scope.step;
				API.Cards.query({limit: $scope.limit, begins: $scope.search, type: $scope.type, colors: $scope.colors, rarity: $scope.rarity}, updateCards);
			}

			function updateCards(cards) {
				$scope.$emit('cardsUpdated', cards);
			}
		}])

		.controller("CardModalCtrl", ["$scope", "$modalInstance", function($scope, $modalInstance) {
			
		}])

		.controller("PlaneListCtrl", ["$scope", "API", "$routeParams", "$location", "$modal", function($scope, API, $routeParams, $location, $modal) {
			$scope.planeRows;
			$scope.planes;
			API.Planes.query(function(planes) {
				$scope.$emit('planesUpdated', planes);
			});

			$scope.$on("planesUpdated", function(evt, planes) {
				$scope.planes = planes;
				$scope.planeRows = planes.chunk(4);
			});

			$scope.selectRandom = function() {
				API.Planes.query({randomize: 1}, function(planes) {
					$scope.$emit('planesUpdated', planes);
				});
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