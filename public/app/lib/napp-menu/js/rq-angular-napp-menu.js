/**
 *  Module
 *
 * Description
 */
define(["angular"], function(angular) {
	'use strict';

	return angular.module('napp.menu', [])
		.directive('menu', ["$location",
			function(location) {
				return {
					restrict: "AE",
					transclude: true,
					replace: true,
					scope: {
						title: "@"
					},
					controller: function($scope) {
						$scope.items = [];

						this.addItem = function(match, element) {
							$scope.items.push({"element": element, "match": match});

							var reg = new RegExp(match);

							if (reg.test(location.path())) {
								angular.element(element).addClass("active");
							}
						};

						$scope.$on("$routeChangeStart", function() {
							var route = location.path();

							for (var item in $scope.items) {
								item = $scope.items[item];
								var reg = new RegExp(item.match);
								if (reg.test(route)) {
									angular.element(item.element).addClass("active");
								} else {
									angular.element(item.element).removeClass("active");
								}
							}
						});
					},
					templateUrl: "/app/lib/napp-menu/partials/menu.html",
				};
			}
		])
		.directive("menuItemParent", function() {
			return {
				require: "^menu",
				restrict: "AE",
				replace: true,
				transclude: true,
				scope: {
					match: "@",
					title: "@"
				},
				link: function(scope, element, attrs, menuCtrl) {
					menuCtrl.addItem(scope.match, element);
				},
				templateUrl: "/app/lib/napp-menu/partials/menu-item-parent.html"
			};
		})
		.directive('menuItem', function() {
			return {
				require: "^menu",
				restrict: 'AE',
				replace: true,
				transclude: true,
				scope: {
					match: "@",
					route: "@",
					title: "@"
				},
				link: function(scope, element, attrs, menuCtrl) {
					menuCtrl.addItem(scope.match, element);
				},
				templateUrl: "/app/lib/napp-menu/partials/menu-item.html",
			}
		});
});