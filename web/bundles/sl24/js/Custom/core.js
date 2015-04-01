var Sl24 = angular.module('Sl24', ['ngRoute', 'ngAnimate']);

Sl24.config(['$interpolateProvider', '$httpProvider', '$routeProvider', '$locationProvider',
    function ($interpolateProvider, $httpProvider, $routeProvider, $locationProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

        $routeProvider
            .when('/', {
                templateUrl: TEMPLATES.index,
                controller: 'indexController'
            })
            .when('/trading', {
                templateUrl: TEMPLATES.trading,
                controller: 'tradingController'
            })
            .when('/logout', {
            });

        $locationProvider.html5Mode(true);
    }
]);