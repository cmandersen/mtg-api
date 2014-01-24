define(["angular"], function(angular) {
	'use strict';

	return angular.module("mtg.services", [])
		.factory("User", ["$cookieStore", function UserFactory($cookieStore) {
			return {
				user: $cookieStore.get("user") || {},

				getKey: function() {
					return this.user.api_key;
				},

				setUser: function(data) {
					this.user = data;
					$cookieStore.put("user", data);
				},

				isLoggedIn: function() {
					return $cookieStore.get("user") ? true : false;
				},

				isAdmin: function() {
					return $cookieStore.get("user") ? $cookieStore.get("user").username == "cmandersen" : false;
				},

				logout: function() {
					this.user = {};
					$cookieStore.remove("user");
				}
			};
			
		}])

		.factory("API", ["$resource", function($resource) {
			return {
				Cards: $resource("/api/v1/cards/:id", {id: "@id"}),
				Planes: $resource("/api/v1/planes/:id", {id: "@id"}),
			};
		}]);
});