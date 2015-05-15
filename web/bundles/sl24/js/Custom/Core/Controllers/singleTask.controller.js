(function () {
    angular.module('Sl24').controller('SingleTaskController', SingleTaskController);

    SingleTaskController.$inject = [
        '$scope',
        '$routeParams',
        '$tasks'
    ];

    function SingleTaskController($scope, $routeParams, $tasks) {

        $scope.task_id = $routeParams.task_id;
        $scope.task = null;
        $scope.taskInfoEdit = null;
        $scope.taskStatuses = null;

        $scope.getTask = function (task_id) {
            var promise = $tasks.getTask(task_id);
            promise.then(function (response) {
                response = response.data;
                $scope.task = response;
                $scope.taskInfoEdit = response;
                $scope.taskInfoEdit.date = new Date($scope.taskInfoEdit.date);
                getStatuses();
            });
        };

        function getStatuses() {
            var promise = $tasks.getTaskStatuses();
            promise.then(function (response) {
                $scope.taskStatuses = response.data;
            });
        }

        $scope.saveTaskInfo = function (task) {
            $tasks.saveTask(task);
        };
    }
})();
