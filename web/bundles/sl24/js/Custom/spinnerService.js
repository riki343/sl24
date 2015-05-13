Sl24.factory('$spinner', ['$rootScope', '$q',
    function($rootScope, $q) {
        var self = this;
        this.promises = [];
        this.checkPromises = function (promise) {
            var promiseIndex = self.promises.indexOf(promise);
            self.promises.splice(promiseIndex, 1);
            self.isInProgress = (self.promises.length > 0);
            $rootScope.$broadcast('promisesEnd');
        };

        return {
            'addPromise': function (promise) {
                if (self.promises.length == 0) {
                    $rootScope.$broadcast('promisesStart');
                }
                self.promises.push(promise);
                promise.then(self.checkPromises(promise));
            },
            'promisesEnd': function ($scope, handler) {
                $scope.$on('promisesEnd', function () {
                    handler();
                });
            },
            'promisesStart': function ($scope, handler) {
                $scope.$on('promisesStart', function () {
                    handler();
                });
            }
        }
    }
]);