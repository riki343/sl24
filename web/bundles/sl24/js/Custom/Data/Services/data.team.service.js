(function () {
    angular.module('Sl24.data')
        .factory('$team', teamService);

    teamService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function teamService($http, $q, $spinner, URLS) {

        var team = {
            'getTeam': getTeam
        };

        return team;

        function getTeam() {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getTeam);
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }
    }
})();