(function () {
    angular.module('Sl24.data')
        .factory('$quotes', quotesService);

    quotesService.$inject = [
        '$http',
        '$q',
        'URLS'
    ];

    function quotesService($http, $q, URLS) {

        var quotes = {

        };

        return quotes;
    }
})();