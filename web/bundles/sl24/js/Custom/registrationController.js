Sl24.controller('RegistrationController', ['$scope', '$http',
    function ($scope, $http) {
        $scope.urlAddNewUser = URLS.addNewUser;

        $scope.addUser = {
            'login': null, 'pass': null,
            'rpass': null, 'email': null,
            'slNumber': null
        };

        $scope.modalHeader = null;
        $scope.addedUser = null;

        $scope.register = function (info) {
            if (info.pass != info.rpass) {
                // *******
                return;
            }
            $http.post($scope.urlAddNewUser, { 'info': info })
                .success(function (response) {
                    if (response) {
                        $scope.addedUser = $scope.addUser.login;
                        $scope.modalHeader = "Успішно виконано!";
                        $scope.modalBody = "Користувач " + $scope.addedUser + " успішно доданий";

                        $scope.addUser.login = null;
                        $scope.addUser.pass = null;
                        $scope.addUser.rpass = null;
                        $scope.addUser.email = null;
                        $scope.addUser.slNumber = null;
                    } else {
                        $scope.modalHeader = "Помилка!";
                        $scope.modalBody = null;
                    }

                    $('#add_new_user').modal('show');
                }
            );
        };
    }
]);