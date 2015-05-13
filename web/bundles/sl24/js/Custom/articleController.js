Sl24.controller('ArticleController', ['$scope', '$http', '$sce', '$routeParams', '$spinner',
    function ($scope, $http, $sce, $routeParams, $spinner) {
        $scope.urlGetArticle = URLS.urlGetArticle;
        $scope.urlAddArticle = URLS.urlAddArticle;
        $scope.urlGetFullArticle = URLS.urlGetFullArticle;
        $scope.Articles = [];
        $scope.Article = null;
        $scope.user = [];
        $scope.img = null;
        $scope.asset = URLS.asset;
        $scope.article_id = $routeParams.article_id;

        $scope.GetArticle = function () {
            var promise = $http.get($scope.urlGetArticle)
                .success(function (response) {
                    $scope.user =  response.user;
                    $scope.Articles = response.articles;
                    for(var i = 0; i < $scope.Articles.length; i++) {
                        $scope.Articles[i].articleText = $sce.trustAsHtml($scope.Articles[i].articleText);
                    }
                }
            );
            $spinner.addPromise(promise);
        };

        $scope.ShowFullArticle = function (id) {
            var urlGetFullArticle = $scope.urlGetFullArticle.replace('0', id);
            var promise = $http.get(urlGetFullArticle)
                .success(function (response){
                    $scope.Article =  response.article;
                    $scope.Article.articleText = $sce.trustAsHtml($scope.Article.articleText);
                }
            );
            $spinner.addPromise(promise);
        };
    }
]);