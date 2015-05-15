(function () {
    angular.module('Sl24').controller('SettingsController', SettingsController);

    SettingsController.$inject = [
        '$scope',
        '$settings',
        '$routeParams'
    ];

    function SettingsController($scope, $settings, $routeParams) {
        var self = this;

        this.ownPage = !angular.isDefined($routeParams.consultant_id);
        this.consultantID = $routeParams.consultant_id;

        $scope.changePassModel = {
            'newPass': '',
            'rNewPass': ''
        };
        $scope.user = {};

        this.getUserSettings = function () {
            var id = (self.ownPage) ? $scope.userID : self.consultantID;
            var promise = $settings.getUserSettings(id);
            promise.then(function (response) {
                response = response.data;
                $scope.user = response;
                $scope.user.birthday = new Date($scope.user.birthday);
            });
        };

        this.saveSettings = function () {
            var id = (self.ownPage) ? $scope.userID : self.consultantID;
            $settings.saveSettings(id, $scope.user);
        };

        this.saveNewPass = function () {
            var id = (self.ownPage) ? $scope.userID : self.consultantID;
            $settings.saveNewPass(id, $scope.changePassModel);
        };
    }
})();