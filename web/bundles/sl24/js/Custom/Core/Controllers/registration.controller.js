(function () {
    angular.module('Sl24').controller('RegistrationController', RegistrationController);

    RegistrationController.$inject = [
        '$scope',
        '$registration'
    ];

    function RegistrationController($scope, $registration) {
        var tempUser = {
            'login': null, 'pass': null,
            'rpass': null, 'email': null,
            'slNumber': '',
            'score': 0, 'teamScore': 0,
            'parker': false, 'diary': false,
            'cufflinks': false, 'watches': false,
            'director': null, 'middleName': '',
            'level': 1
        };

        $scope.addUser = tempUser.clone();

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

            var promise = $registration.register(info);
            promise.then(function (response) {
                switch (response.data) {
                    case 1:
                        $scope.addUser = tempUser.clone();
                        break;
                    case -2:
                        break;
                }
            });
        };
    }
})();
