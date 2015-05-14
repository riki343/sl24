(function () {
    angular.module('Sl24').factory('$spinner', $spinner);

    $spinner.$inject = [
        '$rootScope'
    ];

    function $spinner($rootScope) {
        var self = this;
        this.promises = [];

        var spinner = {
            'addPromise': addPromise,
            'onPromisesEnd': onPromisesEnd,
            'onPromisesStart': onPromisesStart
        };

        return spinner;

        function addPromise(promise) {
            if (self.promises.length == 0) {
                $rootScope.$broadcast('promisesStart');
            }
            self.promises.push(promise);
            promise.then(function () {
                var promiseIndex = self.promises.indexOf(promise);
                self.promises.splice(promiseIndex, 1);
                self.isInProgress = (self.promises.length > 0);
                $rootScope.$broadcast('promisesEnd');
            });
        }

        function onPromisesEnd($scope, handler) {
            $scope.$on('promisesEnd', function () {
                handler();
            });
        }

        function onPromisesStart($scope, handler) {
            $scope.$on('promisesStart', function () {
                handler();
            });
        }
    }
})();
