Sl24.controller('TaskController', ['$scope', '$http',
    function ($scope, $http) {

        $scope.tasks = null;
        $scope.urlGetTasks = URLS.getTasks;
        $scope.urlAddTask = URLS.urlAddTask;
        $scope.urlDeleteTask = URLS.urlDeleteTask;
        $scope.taskTable = TEMPLATES.taskTable;
        $scope.taskAgile = TEMPLATES.taskAgile;
        $scope.taskAdd = TEMPLATES.taskAdd;
        $scope.taskDelete = TEMPLATES.taskDelete;

        $scope.taskModel = {
            'id' : null,
            'name': null,
            'description': null
        };

        $scope.getTasks = function () {
            $scope.promise = $http.get($scope.urlGetTasks)
                .success(function (response) {
                    $scope.tasks = response;
                }
            );

            $scope.promise.then(function () {

            });
        };

        $scope.addTask = function (task) {
            if (task && task.name && task.description) {
                $('#add_new_task').modal('hide');
                $scope.promise = $http.post($scope.urlAddTask, {'task': task})
                    .success(function () {
                        $scope.getTasks();
                    }
                );
            }
        };

        $scope.deleteTask = function (task_id) {
            if (task_id) {
                $('#delete_task').modal('hide');
                $scope.promise = $http.post($scope.urlDeleteTask, {'task_id': task_id})
                    .success(function () {
                        $scope.getTasks();
                    });
            }
        };

        $scope.addDeleteTaskId = function (task_id) {
            $scope.taskModel.id = task_id;
        };

    }
]);