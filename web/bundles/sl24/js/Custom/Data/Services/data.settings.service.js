(function () {
    angular.module('Sl24.data').factory('$settings', settingsService);

    settingsService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function settingsService($http, $q, $spinner, URLS) {

        var settings = {
            'getUserSettings': getUserSettings,
            'saveSettings': saveSettings,
            'saveNewPass': saveNewPass
        };

        return settings;

        function getUserSettings(id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getUserSettings.replace('user_id', id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function saveSettings(id, user) {
            var deffered = $q.defer();
            var promise = $http.post(
                URLS.saveUserSettings.replace('user_id', id),
                { 'user': user }
            );
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function saveNewPass(id, user) {
            var deffered = $q.defer();
            var promise = $http.post(
                URLS.saveNewPass.replace('user_id', id),
                { 'user': user }
            );
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }
    }
})();