Sl24.controller('TeamController', ['$scope', '$http',
    function ($scope, $http) {
        $scope.Team = null;
        $scope.urlGetTeam = URLS.urlGetTeam;
        $scope.childs = [];


        $scope.GetTeam = function () {
            $http.get($scope.urlGetTeam)
                .success(function (response) {
                    $scope.Team = response;
                    $scope.Team.lvl = 1;
                    tree($scope.Team,$scope.Team.lvl);
                });
        };

        function tree(elem,lvl)
        {
         for(var i=0;i < elem.childs.length;i++)
         {
             elem.childs[i].lvl = lvl + 1;
             $scope.childs.push(elem.childs[i]) ;
            tree(elem.childs[i],elem.childs[i].lvl) ;
         }
        }

        $scope.showChildForTeam = function(Team,lvl)
        {
            for(var i=0;i<$scope.childs.length;i++)
            {
                if($scope.childs[i].lvl == lvl + 1)
                {
                    $scope.childs[i].visibleelem = true;
                }
            }

        };
        console.log('TeamController was loaded!!!')
    }
]);