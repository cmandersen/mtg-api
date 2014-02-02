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
				Cards: $resource("http://mtg.cmandersen.com/api/v1/cards/:id", {id: "@id"}),
				Planes: $resource("http://mtg.cmandersen.com/api/v1/planes/:id", {id: "@id"}),
			};
		}])
		.service("Plane", ["API", "$rootScope", function(API, $rootScope) {
			this.planes = []
			this.get = function(callback) {
				if(this.planes.length > 0) {
					console.log("Exists");
					callback(this.planes);
					return this.planes;
				} else {
					console.log("Getting...");
					return API.Planes.query(function(planes) {
						$rootScope.$emit("setPlanes", planes);
						callback(planes);
					});
				}
				
			}

			$rootScope.$on("setPlanes", function(planes) {
				this.planes = planes;
			}.bind(this));

			$rootScope.$on("randomPlanes", function() {
				API.Planes.query({randomize: true}, function(planes) {
					$rootScope.$emit("setPlanes", planes);
					$rootScope.$broadcast("planesUpdated", planes);
				});
			});
		}]);
});