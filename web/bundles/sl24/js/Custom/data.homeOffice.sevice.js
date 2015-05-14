(function () {
    angular.module('Sl24')
        .factory('$homeOffice', homeOfficeService);

    homeOfficeService.$inject = ['$http', '$q'];

    function homeOfficeService($http, $q) {

        var homeOffice = {
            'getHomeOfficeInfo': getHomeOfficeInfo,
        };

        return homeOffice;

        function getHomeOfficeInfo(id) {
            var deffered = $q.defer();
            $http.get(URLS.userHomepageGetInfo.replace('0', id))
                .success(function (data) {
                    return deffered.resolve(data);
                }
            );
            return deffered.promise;
        }
    }
})();