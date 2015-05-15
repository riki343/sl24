(function () {
    angular.module('Sl24').controller('ArticleController', ArticleController);

    ArticleController.$inject = [
        '$scope',
        '$sce',
        '$routeParams',
        'URLS',
        '$articles'
    ];

    function ArticleController($scope, $sce, $routeParams, URLS, $articles) {
        $scope.Articles = [];
        $scope.Article = null;
        $scope.user = [];
        $scope.img = null;
        $scope.asset = URLS.asset;
        $scope.article_id = $routeParams.article_id;

        $scope.GetArticle = function () {
            var promise = $articles.getArticles();
            promise.then(function (response) {
                $scope.user = response.data.user;
                $scope.Articles = response.data.articles;
                for(var i = 0; i < $scope.Articles.length; i++) {
                    $scope.Articles[i].articleText = $sce.trustAsHtml($scope.Articles[i].articleText);
                }
            });
        };

        $scope.ShowFullArticle = function (id) {
            var promise = $articles.getFullArticle(id);
            promise.then(function(response) {
                $scope.Article = response.data.article;
                $scope.Article.articleText = $sce.trustAsHtml($scope.Article.articleText);
            });
        };
    }
})();