Sl24.controller('HomepageController', ['$scope', '$http', '$rootScope',
    function ($scope, $http, $rootScope) {
        var urlHomepageGetInfo = URLS.homepageGetInfo;
        $scope.meetings = [];
        $scope.tasks = [];
        $scope.birthdays = [];
        $scope.total = {
            'today': 0,
            'tommorow': 0
        };

        $scope.getHomeOfficeInfo = function () {
            $rootScope.spinner = true;
            $http.get(urlHomepageGetInfo)
                .success(function (response) {
                    $scope.meetings = response.meetings;
                    $scope.tasks = response.tasks;
                    $scope.birthdays = response.birthdays;
                    $scope.homeChilds = response.childs;
                    $scope.homeUser = response.user;
                    $scope.total.today = $scope.meetings.today.length + $scope.tasks.today.length;
                    $scope.total.tommorow = $scope.meetings.tommorow.length + $scope.tasks.tommorow.length;
                    $rootScope.spinner = false;
                }
            );
        };
    }
]);