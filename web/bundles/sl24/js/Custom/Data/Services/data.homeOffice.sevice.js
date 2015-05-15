(function () {
    angular.module('Sl24.data')
        .factory('$homeOffice', homeOfficeService);

    homeOfficeService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function homeOfficeService($http, $q, $spinner, URLS) {

        var homeOffice = {
            'getHomeOfficeInfo': getHomeOfficeInfo,
        };

        return homeOffice;

        function getHomeOfficeInfo(id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.userHomepageGetInfo.replace('0', id));
            promise.then(function (data) {
                    deffered.resolve(data);
                }
            );
            $spinner.addPromise(promise);
            return deffered.promise;
        }
    }
})();