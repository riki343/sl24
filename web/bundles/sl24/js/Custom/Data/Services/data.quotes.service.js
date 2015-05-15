(function () {
    angular.module('Sl24.data')
        .factory('$quotes', quotesService);

    quotesService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function quotesService($http, $q, $spinner, URLS) {

        var quotes = {

        };

        return quotes;
    }
})();