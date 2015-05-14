(function () {
    angular.module('Sl24.data')
        .factory('$career', careerService);

    careerService.$inject = [
        '$http',
        '$q',
        'URLS'
    ];

    function careerService($http, $q, URLS) {

        var career = {

        };

        return career;
    }
})();