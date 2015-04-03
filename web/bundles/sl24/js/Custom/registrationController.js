Sl24.controller('RegistrationController', ['$scope', '$http',
    function ($scope, $http) {
        $scope.urlAddNewUser = URLS.addNewUser;

        $scope.addUser = {
            'login': null,
            'pass': null,
            'rpass': null,
            'email': null,
            'slNumber': null,
            'score': 0,
            'teamScore': 0,
            'parker': false,
            'diary': false,
            'cufflinks': false,
            'watches': false,
            'directorNumber': null
        };

        $scope.modalHeader = null;
        $scope.addedUser = null;

        $scope.register = function (info) {
            if (!info.name) {
                $('#name');
                return;
            } else if (!info.pass || info.pass != info.rpass) {
                $('#rpass');
                return;
            } else if (!info.email) {
                $('#email');
                return;
            } else if (!info.slNumber) {
                $('#slNumber');
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
                        $scope.addUser.score = 0;
                        $scope.addUser.teamScore = 0;
                        $scope.addUser.parker = false;
                        $scope.addUser.diary = false;
                        $scope.addUser.cufflinks = false;
                        $scope.addUser.watches = false;
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