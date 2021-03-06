(function () {
    angular.module('Sl24').config(Sl24Config);

    Sl24Config.$inject = [
        '$interpolateProvider',
        '$httpProvider',
        '$routeProvider',
        '$locationProvider',
        'TEMPLATES'
    ];

    function Sl24Config($interpolateProvider, $httpProvider, $routeProvider, $locationProvider, TEMPLATES) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

        $routeProvider
            .when('/consultant/', {
                templateUrl: TEMPLATES.main,
                controller: 'HomepageController'
            })
            .when('/consultant/settings', {
                templateUrl: TEMPLATES.settings,
                controller: 'SettingsController as sctrl'
            })
            .when('/consultant/meetings', {
                templateUrl: TEMPLATES.meetings,
                controller: 'MeetingController'
            })
            .when('/consultant/meeting/:meeting_id', {
                templateUrl: TEMPLATES.meeting,
                controller: 'SingleMeetingController'
            })
            .when('/consultant/meeting/edit/:meeting_id', {
                templateUrl: TEMPLATES.meetingEdit,
                controller: 'SingleMeetingController'
            })
            .when('/consultant/tasks', {
                templateUrl: TEMPLATES.tasks,
                controller: 'TaskController'
            })
            .when('/consultant/task/:task_id', {
                templateUrl: TEMPLATES.task,
                controller: 'SingleTaskController'
            })
            .when('/consultant/team', {
                templateUrl: TEMPLATES.team,
                controller: 'TeamController'
            })
            .when('/consultant/register', {
                templateUrl: TEMPLATES.registration,
                controller: 'RegistrationController'
            })
            .when('/consultant/article', {
                templateUrl: TEMPLATES.article,
                controller: 'ArticleController'
            })
            .when('/consultant/article/getfull/:article_id', {
                templateUrl: TEMPLATES.fullArticle,
                controller: 'ArticleController'
            })
            .when('/consultant/career', {
                templateUrl: TEMPLATES.career,
                controller: 'CareerController as career'
            })
            .when('/consultant/seminars', {
                templateUrl: TEMPLATES.seminars,
                controller: 'SeminarsController as seminars'
            })
            .when('/consultant/quotes', {
                templateUrl: TEMPLATES.quotes,
                controller: 'QuotesController as quotes'
            })
            .when('/consultant/:consultant_id', {
                templateUrl: TEMPLATES.main,
                controller: 'HomepageController'
            })
            .when('/consultant/:consultant_id/settings', {
                templateUrl: TEMPLATES.settings,
                controller: 'SettingsController as sctrl'
            })
            .when('/consultant/:consultant_id/meetings', {
                templateUrl: TEMPLATES.meetings,
                controller: 'MeetingController'
            })
            .when('/consultant/:consultant_id/meeting/:meeting_id', {
                templateUrl: TEMPLATES.meeting,
                controller: 'SingleMeetingController'
            })
            .when('/consultant/:consultant_id/meeting/edit/:meeting_id', {
                templateUrl: TEMPLATES.meetingEdit,
                controller: 'SingleMeetingController'
            })
            .otherwise({
                redirectTo: '/consultant/'
            });

        $locationProvider.html5Mode(true);
    }
})();