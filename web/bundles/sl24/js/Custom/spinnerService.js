Sl24.factory('$spinner', ['$rootScope',
    function($rootScope) {
        var self = this;
        this.promises = [];

        var spinner = {
            'addPromise': function (promise) {
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
            },
            'onPromisesEnd': function ($scope, handler) {
                $scope.$on('promisesEnd', function () {
                    handler();
                });
            },
            'onPromisesStart': function ($scope, handler) {
                $scope.$on('promisesStart', function () {
                    handler();
                });
            }
        };

        return spinner;
    }
]);