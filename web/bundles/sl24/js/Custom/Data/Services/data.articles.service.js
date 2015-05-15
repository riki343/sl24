(function () {
    angular.module('Sl24.data')
        .factory('$articles', articlesService);

    articlesService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function articlesService($http, $q, $spinner, URLS) {

        var articles = {
            'getArticles': getArticles,
            'getFullArticle': getFullArticle
        };

        return articles;

        function getArticles() {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getArticles);
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function getFullArticle(id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getFullArticle.replace('0', id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        /// URLS.addArticle
        function addArticle() {

        }
    }
})();