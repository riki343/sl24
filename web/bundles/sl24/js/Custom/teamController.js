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
                    $scope.Team.marginrigth = 0;
                    $scope.Team.visible = false;

                    tree($scope.Team,$scope.Team.lvl,$scope.Team.marginrigth);
                });
        };

        function tree(elem,lvl,marginrigth)
        {
         for(var i=0;i < elem.childs.length;i++)
         {
             elem.childs[i].lvl = lvl + 1;
             elem.childs[i].visible = false;
             elem.childs[i].marginrigth = marginrigth + 25;
             $scope.childs.push(elem.childs[i]) ;
            tree(elem.childs[i],elem.childs[i].lvl,elem.childs[i].marginrigth) ;
         }
        }

        $scope.showChildForTeam = function(Team,lvl)
        {
            Team.visible = true;
            for(var i=0;i<$scope.childs.length;i++)
            {
                if($scope.childs[i].lvl == lvl + 1)
                {
                    $scope.childs[i].visibleelem = true;
                }
            }

        };
        $scope.removeChildForTeam = function(Team,lvl)
        {
            Team.visible = false;
            for(var i=0;i<$scope.childs.length;i++)
            {
                if($scope.childs[i].lvl == lvl + 1)
                {
                    $scope.childs[i].visibleelem = false;
                    $scope.removeChildForTeam( $scope.childs[i],$scope.childs[i].lvl);
                }
            }

        };
        console.log('TeamController was loaded!!!')
    }
]);