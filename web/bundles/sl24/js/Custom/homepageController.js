Sl24.controller('HomepageController', ['$scope', '$http', '$rootScope', '$routeParams',
    function ($scope, $http, $rootScope, $routeParams) {
        var urlHomepageGetInfo = URLS.homepageGetInfo;
        var urlUserHomepageGetInfo = URLS.userHomepageGetInfo;
        $scope.meetings = [];
        $scope.tasks = [];
        $scope.birthdays = [];
        $scope.total = {
            'today': 0,
            'tommorow': 0
        };

        var ownPage = !angular.isDefined($routeParams.consultant_id);
        $scope.ownPage = ownPage;
        $scope.consultant = (!ownPage) ? $routeParams.consultant_id : null;

        $scope.getHomeOfficeInfo = function () {
            $rootScope.spinner = true;
            var requestUrl = (ownPage)
                ? urlHomepageGetInfo
                : urlUserHomepageGetInfo.replace('0', $routeParams.consultant_id);

            $http.get(requestUrl)
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