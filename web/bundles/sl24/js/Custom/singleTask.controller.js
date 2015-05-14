(function () {
    angular.module('Sl24').controller('SingleTaskController', SingleTaskController);

    SingleTaskController.$inject = [
        '$scope',
        '$http',
        '$routeParams',
        '$spinner'
    ];

    function SingleTaskController($scope, $http, $routeParams, $spinner) {

        $scope.task_id = $routeParams.task_id;
        $scope.task = null;
        $scope.taskInfoEdit = null;
        $scope.taskStatuses = null;

        $scope.urlGetTask = URLS.urlGetTask;
        $scope.urlGetStatuses = URLS.urlGetStatuses;
        $scope.urlSaveTaskInfo = URLS.urlSaveTaskInfo;

        $scope.getTask = function (task_id) {
            var urlGetTask = $scope.urlGetTask.replace('task_id', task_id);
            var promise = $scope.taskPromise = $http.get(urlGetTask)
                .success(function (response){
                    $scope.task = response;
                    $scope.taskInfoEdit = response;
                    $scope.taskInfoEdit.date = new Date($scope.taskInfoEdit.date);
                    getStatuses();
                }
            );
            $spinner.addPromise(promise);
        };

        function getStatuses() {
            var promise = $http.get($scope.urlGetStatuses)
                .success(function (response) {
                    $scope.taskStatuses = response;
                }
            );
            $spinner.addPromise(promise);
        }

        $scope.saveTaskInfo = function (task) {
            var promise = $http.post($scope.urlSaveTaskInfo, { 'task': task });
            $spinner.addPromise(promise);
        };
    }
})();
