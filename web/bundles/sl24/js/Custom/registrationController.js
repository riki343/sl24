Sl24.controller('RegistrationController', ['$scope', '$http', '$spinner',
    function ($scope, $http, $spinner) {
        var urlAddNewUser = URLS.addNewUser;

        $scope.addUser = {
            'login': null,
            'pass': null,
            'rpass': null,
            'email': null,
            'slNumber': '',
            'score': 0,
            'teamScore': 0,
            'parker': false,
            'diary': false,
            'cufflinks': false,
            'watches': false,
            'director': null,
            'middleName': '',
            'level': 1
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
            info.login = info.slNumber;
            var promise = $http.post(urlAddNewUser, { 'info': info })
                .success(function (response) {
                    switch (response) {
                        case 1:
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
                            break;
                        case -2:
                            $scope.modalHeader = "Помилка!";
                            $scope.modalBody = 'Неправильний Sl-номер керівника';
                            break;
                    }
                }
            );
            $spinner.addPromise(promise);
        };
    }
]);