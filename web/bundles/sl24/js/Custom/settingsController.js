Sl24.controller('SettingsController', ['$http',
    function ($http) {
        var self = this;

        this.urlGetUserSettings = URLS.getUserSettings;
        this.user = {};

        this.getUserSettings = function () {
            $http.get(self.urlGetUserSettings)
                .success(function (response) {

                }
            );
        };
    }
]);