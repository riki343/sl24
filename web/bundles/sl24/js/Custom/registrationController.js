Sl24.controller('RegistrationController', ['$scope', '$http',
    function ($scope, $http) {
        $scope.urlAddNewUser = URLS.addNewUser;

        $scope.addUser = {
            'login': null,
            'pass': null,
            'rpass': null,
            'email': null,
            'slNumber': null
        };

        $scope.addedUser = null;

        $scope.register = function (info) {
            if (info.pass != info.rpass) {
                // *******
                return;
            }
            $http.post($scope.urlAddNewUser, { 'info': info })
                .success(function (response) {
                    $scope.addedUser = $scope.addUser.login;
                    $('#add_new_user').modal('show');
                    $scope.addUser.login = null;
                    $scope.addUser.pass = null;
                    $scope.addUser.rpass = null;
                    $scope.addUser.email = null;
                    $scope.addUser.slNumber = null;
                }
            );
        };
    }
]);