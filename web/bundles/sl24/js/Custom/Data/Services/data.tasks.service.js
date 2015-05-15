(function () {
    angular.module('Sl24.data')
        .factory('$tasks', tasksService);

    tasksService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function tasksService($http, $q, $spinner, URLS) {

        var tasks = {
            'getTask': getTask,
            'getTasks': getTasks,
            'getTaskStatuses': getTaskStatuses,
            'saveTask': saveTask,
            'addTask': addTask,
            'deleteTask': deleteTask
        };

        return tasks;

        function getTask(task_id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getTask.replace('task_id', task_id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function getTaskStatuses() {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getTaskStatuses);
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function saveTask(task) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.saveTaskInfo, { 'task': task });
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function getTasks() {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getTasks);
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function addTask(task) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.addTask,
                { 'task': task }
            );
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;

        }

        function deleteTask(task_id) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.deleteTask,
                { 'task_id': task_id }
            );
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

    }
})();