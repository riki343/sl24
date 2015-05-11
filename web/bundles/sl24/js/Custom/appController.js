Sl24.controller('AppController', ['$scope', '$http', '$rootScope',
    function ($scope, $http, $rootScope) {
        $scope.userID = USER_ID;
        $scope.userLevel = USER_LEVEL;
        $rootScope.spinner = false;
        $scope.watches = new Date();

        setInterval(function () {
            $scope.$apply(function () {
                    $scope.watches = new Date();
                }
            );
        }, 1000);
    }
]);