(function () {
    angular.module('Sl24').controller('TaskController', TaskController);

    TaskController.$inject = [
        '$scope',
        '$tasks'
    ];

    function TaskController($scope, $tasks) {

        $scope.tasks = null;
        $scope.taskTable = TEMPLATES.taskTable;
        $scope.taskAgile = TEMPLATES.taskAgile;
        $scope.taskAdd = TEMPLATES.taskAdd;
        $scope.taskDelete = TEMPLATES.taskDelete;

        $scope.taskModel = {
            'id' : null,
            'name': '',
            'description': '',
            'date': new Date()
        };

        $scope.todoTasks = [];
        $scope.inProgresTasks = [];
        $scope.doneTasks = [];

        $scope.getTasks = function () {
            var promise = $tasks.getTasks();
            promise.then(function (response) {
                response = response.data;
                $scope.tasks = response;
                separationTasksByStatus(response);
            });
        };

        $scope.addTask = function (task) {
            if (task && task.name && task.description) {
                $('#add_new_task').modal('hide');
                var promise = $tasks.addTask(task);
                promise.then($scope.getTasks);
            }
        };

        $scope.deleteTask = function (task_id) {
            if (task_id) {
                $('#delete_task').modal('hide');
                var promise = $tasks.deleteTask(task_id);
                promise.then($scope.getTasks);
            }
        };

        $scope.addDeleteTaskId = function (task_id) {
            $scope.taskModel.id = task_id;
        };

        function separationTasksByStatus(tasks)
        {
            $scope.storyTasks = [] ;
            $scope.todoTasks = [] ;
            $scope.inProgresTasks = [] ;
            $scope.doneTasks = [] ;

            for( var i = 0; i < tasks.length; i++ )
            {
                switch (tasks[i].status.id) {
                    case 1:
                        $scope.todoTasks.push(tasks[i]);
                        break;
                    case 2:
                        $scope.inProgresTasks.push(tasks[i]);
                        break;
                    case 3:
                        $scope.doneTasks.push(tasks[i]);
                        break;
                }
            }
        }

    }
})();