Sl24.controller('SingleTaskController', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {

        $scope.task_id = $routeParams.task_id;
        $scope.task = null;
        $scope.taskInfoEdit = null;
        $scope.taskStatuses = null;

        $scope.urlGetTask = URLS.urlGetTask;
        $scope.urlGetStatuses = URLS.urlGetStatuses;
        $scope.urlSaveTaskInfo = URLS.urlSaveTaskInfo;

        $scope.getTask = function (task_id) {
            var urlGetTask = $scope.urlGetTask.replace('task_id', task_id);
            $scope.taskPromise = $http.get(urlGetTask)
                .success(function (response){
                    $scope.task = response;
                    $scope.taskInfoEdit = response;
                    getStatuses();
                })
        };

        var getStatuses = function () {
            $scope.promiseStatuses = $http.get($scope.urlGetStatuses)
                .success(function (response) {
                    $scope.taskStatuses = response;
                })
        };

        $scope.saveTaskInfo = function (task) {
            $scope.taskPromise = $http.post($scope.urlSaveTaskInfo, { 'task': task })
                .success(function (response) {
                    if (response) {
                        $scope.modalHeader = 'Успішно';
                        $scope.modalBody = 'Інформація про зустріч успішно збережена.';
                    } else {
                        $scope.modalHeader = 'Помилка';
                        $scope.modalBody = 'Невідома помилка.';
                    }
                    $('#edit_meeting').modal('show');
                });
        };

    }
]);