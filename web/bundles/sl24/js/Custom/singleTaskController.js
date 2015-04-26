Sl24.controller('SingleTaskController', ['$scope', '$http', '$routeParams', '$rootScope',
    function ($scope, $http, $routeParams, $rootScope) {

        $scope.task_id = $routeParams.task_id;
        $scope.task = null;
        $scope.taskInfoEdit = null;
        $scope.taskStatuses = null;

        $scope.urlGetTask = URLS.urlGetTask;
        $scope.urlGetStatuses = URLS.urlGetStatuses;
        $scope.urlSaveTaskInfo = URLS.urlSaveTaskInfo;

        $scope.getTask = function (task_id) {
            $rootScope.spinner = true;
            var urlGetTask = $scope.urlGetTask.replace('task_id', task_id);
            $scope.taskPromise = $http.get(urlGetTask)
                .success(function (response){
                    $scope.task = response;
                    $scope.taskInfoEdit = response;
                    $scope.taskInfoEdit.date = new Date($scope.taskInfoEdit.date);
                    getStatuses();
                    $rootScope.spinner = false;
                }
            );
        };

        function getStatuses() {
            $scope.promiseStatuses = $http.get($scope.urlGetStatuses)
                .success(function (response) {
                    $scope.taskStatuses = response;
                }
            );
        }

        $scope.saveTaskInfo = function (task) {
            $rootScope.spinner = true;
            $scope.taskPromise = $http.post($scope.urlSaveTaskInfo, { 'task': task })
                .success(function (response) {
                    if (response) {
                        $rootScope.spinner = false;
                    }
                }
            );
        };

    }
]);