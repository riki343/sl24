Sl24.controller('ArticleController', ['$scope', '$http', '$sce', '$routeParams',
    function ($scope, $http, $sce, $routeParams) {
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
            $http.get($scope.urlGetArticle)
                .success(function (response) {
                    $scope.user =  response.user;
                    $scope.Articles = response.articles;
                        for(var i=0; i< $scope.Articles.length; i++ )
                        {
                            $scope.Articles[i].articleText = $sce.trustAsHtml($scope.Articles[i].articleText);
                        }

                });
        };

        $scope.ShowFullArticle = function (id) {
            $http.get($scope.urlGetFullArticle.replace('0', id))
                .success(function (response){
                    $scope.Article =  response.article ;
                }
            );
        };

        console.log('ArticleController was loaded!!!')

    }]);