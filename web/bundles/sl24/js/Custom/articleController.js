Sl24.controller('ArticleController', ['$scope', '$http',
    function ($scope, $http) {
        $scope.urlGetArticle = URLS.urlGetArticle;
        $scope.urlAddArticle = URLS.urlAddArticle;
        $scope.Articles = [];
        $scope.img = null;
        $scope.asset = URLS.asset;

        $scope.GetArticle = function () {
            $http.get($scope.urlGetArticle)
                .success(function (response) {
                    $scope.Articles = response;


                });
        };

        console.log('ArticleController was loaded!!!')

    }]);