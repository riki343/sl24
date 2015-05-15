
(function () {
    angular.module('Sl24.data')
        .factory('$registration', registrationService);

    registrationService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function registrationService($http, $q, $spinner, URLS) {

        var registration = {
            'register': register
        };

        return registration;

        function register(info) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.addNewUser, { 'info': info });
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }
    }
})();