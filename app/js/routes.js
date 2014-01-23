define(['angular', 'app'], function(angular, app) {
	'use strict';

	return app.config(["$routeProvider",
		function($routeProvider) {
			$routeProvider
				.when("/", {
					templateUrl: "app/partials/dashboard.html",
					controller: "DashCtrl"
				})
				.when("/cards", {
					templateUrl: "app/partials/cards/list.html",
					controller: "CardListCtrl"
				})
				.when("/cards/:id", {
					templateUrl: "app/partials/cards/show.html",
					controller: "CardCtrl"
				})
				.when("/planes", {
					templateUrl: "app/partials/cards/planes/list.html",
					controller: "PlaneListCtrl"
				})
				.when("/planes/:id", {
					templateUrl: "app/partials/cards/planes/show.html",
					controller: "PlaneCtrl"
				})
				.when("/login", {
					templateUrl: "app/partials/users/login.html",
					controller: "UserLoginCtrl"
				})
				.when("/update", {
					templateUrl: "app/partials/update.html",
					controller: "UpdateCtrl"
				})
				.otherwise({
					redirectTo: "/"
				});
		}
	]);
});