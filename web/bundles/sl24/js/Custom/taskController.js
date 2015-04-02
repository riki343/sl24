Sl24.controller('TaskController', ['$scope', '$http',
    function ($scope, $http) {

        $scope.tasks = null;
        $scope.urlGetTasks = URLS.getTasks;

        $scope.getTasks = function () {
            $scope.promise = $http.get($scope.urlGetTasks)
                .success(function (response) {
                    $scope.tasks = response;
                }
            );

            $scope.promise.then(function () {

            });
        };

    }
]);