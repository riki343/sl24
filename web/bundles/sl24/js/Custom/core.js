var Sl24 = angular.module('Sl24', ['ngRoute', 'ngAnimate', 'ngMessages']);

Sl24.config(['$interpolateProvider', '$httpProvider', '$routeProvider', '$locationProvider',
    function ($interpolateProvider, $httpProvider, $routeProvider, $locationProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

        $routeProvider
            .when('/', {
                templateUrl: TEMPLATES.main,
                controller: 'HomepageController'
            })
            .when('/meetings', {
                templateUrl: TEMPLATES.meetings,
                controller: 'MeetingController'
            })
            .when('/meeting/:meeting_id', {
                templateUrl: TEMPLATES.meeting,
                controller: 'SingleMeetingController'
            })
            .when('/meeting/edit/:meeting_id', {
                templateUrl: TEMPLATES.meetingEdit,
                controller: 'SingleMeetingController'
            })
            .when('/tasks', {
                templateUrl: TEMPLATES.tasks,
                controller: 'TaskController'
            })
            .when('/task/:task_id', {
                templateUrl: TEMPLATES.task,
                controller: 'SingleTaskController'
            })
            .when('/team', {
                templateUrl: TEMPLATES.team,
                controller: 'TeamController'
            })
            .when('/register', {
                templateUrl: TEMPLATES.registration,
                controller: 'RegistrationController'
            })
            .when('/article', {
                templateUrl: TEMPLATES.article,
                controller: 'ArticleController'
            })
            .otherwise({
                redirectTo: '/'
            });

        $locationProvider.html5Mode(true);
    }
]);