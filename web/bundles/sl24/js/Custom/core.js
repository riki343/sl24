var Sl24 = angular.module('Sl24', ['ngRoute', 'ngAnimate']);

Sl24.config(['$interpolateProvider', '$httpProvider',
    function ($interpolateProvider, $httpProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }
]);