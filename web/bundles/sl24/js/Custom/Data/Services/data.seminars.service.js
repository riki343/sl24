(function () {
    angular.module('Sl24.data')
        .factory('$seminars', seminarsService);

    seminarsService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function seminarsService($http, $q, URLS) {

        var seminars = {

        };

        return seminars;
    }
})();