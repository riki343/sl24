Sl24.controller('ArticleController', ['$scope', '$http', '$sce', '$routeParams', '$rootScope',
    function ($scope, $http, $sce, $routeParams, $rootScope) {
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
            $rootScope.spinner = true;
            $http.get($scope.urlGetArticle)
                .success(function (response) {
                    $scope.user =  response.user;
                    $scope.Articles = response.articles;
                    for(var i=0; i< $scope.Articles.length; i++ )
                    {
                        $scope.Articles[i].articleText = $sce.trustAsHtml($scope.Articles[i].articleText);
                    }
                    $rootScope.spinner = false;
                }
            );
        };

        $scope.ShowFullArticle = function (id) {
            $rootScope.spinner = true;
            var urlGetFullArticle = $scope.urlGetFullArticle.replace('0', id);
            $http.get(urlGetFullArticle)
                .success(function (response){
                    $scope.Article =  response.article ;
                    $scope.Article.articleText = $sce.trustAsHtml($scope.Article.articleText);
                    $rootScope.spinner = false;
                }
            );
        };
    }
]);