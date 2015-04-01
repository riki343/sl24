var Sl24 = angular.module('Sl24', ['ngRoute', 'ngAnimate']);

Sl24.config(['$interpolateProvider', '$httpProvider', '$routeProvider', '$locationProvider',
    function ($interpolateProvider, $httpProvider, $routeProvider, $locationProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

        $routeProvider
            .when('/', {
                templateUrl: TEMPLATES.main,
                controller: 'UserController'
            })
            .when('/meetings', {
                templateUrl: TEMPLATES.meetings,
                controller: 'MeetingController'
            })
            .otherwise({
                redirectTo: '/'
            });

        $locationProvider.html5Mode(true);
    }
]);