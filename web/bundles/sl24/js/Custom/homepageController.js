Sl24.controller('HomepageController', ['$scope', '$http',
    function ($scope, $http) {
        var urlHomepageGetInfo = URLS.homepageGetInfo;
        $scope.meetings = [];
        $scope.tasks = [];
        $scope.birthdays = [];

        $scope.getHomeOfficeInfo = function () {
            $http.get(urlHomepageGetInfo)
                .success(function (response) {
                    $scope.meetings = response.meetings;
                    $scope.tasks = response.tasks;
                    $scope.birthdays = response.birthdays;
                }
            );
        };
    }
]);