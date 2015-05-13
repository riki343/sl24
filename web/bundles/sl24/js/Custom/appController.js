Sl24.controller('AppController', ['$scope', '$http', '$rootScope', '$spinner',
    function ($scope, $http, $rootScope, $spinner) {

        var self = this;
        this.watches = new Date();

        $scope.userID = USER_ID;
        $scope.userLevel = USER_LEVEL;
        this.spinner = false;

        $spinner.onPromisesStart($scope, function () {
            self.spinner = true;
        });

        $spinner.onPromisesEnd($scope, function () {
            self.spinner = false;
        });

        setInterval(function () {
            $scope.$apply(function () {
                self.watches = new Date();
            });
        }, 1000);
    }
]);