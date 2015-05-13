Sl24.controller('SettingsController', ['$scope', '$http', '$spinner', '$routeParams',
    function ($scope, $http, $spinner, $routeParams) {
        var self = this;

        this.urlGetUserSettings = URLS.getUserSettings;
        this.urlSaveUserSettings = URLS.saveUserSettings;
        this.urlSaveNewPass = URLS.saveNewPass;

        this.ownPage = !angular.isDefined($routeParams.consultant_id);
        this.consultantID = $routeParams.consultant_id;

        $scope.changePassModel = {
            'newPass': '',
            'rNewPass': ''
        };

        $scope.user = {};

        this.getUserSettings = function () {
            var replace = (self.ownPage) ? $scope.userID : self.consultantID;
            var requestUrl = self.urlGetUserSettings.replace('user_id', replace);
            var promise = $http.get(requestUrl)
                .success(function (response) {
                    $scope.user = response;
                    $scope.user.birthday = new Date($scope.user.birthday);
                }
            );
            $spinner.addPromise(promise);
        };
        
        this.saveSettings = function () {
            var replace = (self.ownPage) ? $scope.userID : self.consultantID;
            var requestUrl = self.urlSaveUserSettings.replace('user_id', replace);
            var promise = $http.post(requestUrl, { 'user': $scope.user });
            $spinner.addPromise(promise);
        };

        this.saveNewPass = function () {
            var replace = (self.ownPage) ? $scope.userID : self.consultantID;
            var requestUrl = self.urlSaveNewPass.replace('user_id', replace);
            var promise = $http.post(requestUrl, { 'user': $scope.changePassModel });
            $spinner.addPromise(promise);
        };
    }
]);