(function () {
    angular.module('Sl24').controller('TeamController', TeamController);

    TeamController.$inject = [
        '$scope',
        '$team'
    ];

    function TeamController($scope, $team) {
        $scope.Team = null;
        $scope.childs = [];

        $scope.GetTeam = function () {
            var promise = $team.getTeam();
            promise.then(function (response) {
                $scope.Team = response;
                $scope.Team.lvl = 1;
                $scope.Team.marginrigth = 0;
                $scope.Team.visible = false;

                tree($scope.Team,$scope.Team.lvl,$scope.Team.marginrigth);
            });
        };

        function tree(elem, lvl, marginrigth)
        {
            for(var i = 0; i < elem.childs.length; i++)
            {
                elem.childs[i].lvl = lvl + 1;
                elem.childs[i].visible = false;
                elem.childs[i].marginrigth = marginrigth + 8;
                $scope.childs.push(elem.childs[i]);
                tree(elem.childs[i], elem.childs[i].lvl, elem.childs[i].marginrigth);
                $scope.showChildForTeam($scope.Team, 1, $scope.Team.id);
            }
        }

        $scope.showChildForTeam = function(Team,lvl,id)
        {
            Team.visible = true;
            for(var i=0;i<$scope.childs.length;i++)
            {
                if($scope.childs[i].lvl == lvl + 1 && $scope.childs[i].parentID == id)
                {
                    $scope.childs[i].visibleelem = true;
                }
            }
        };

        $scope.removeChildForTeam = function(Team,lvl,id)
        {
            Team.visible = false;
            for(var i = 0; i<$scope.childs.length; i++)
            {
                if($scope.childs[i].lvl == lvl + 1 && $scope.childs[i].parentID == id)
                {
                    $scope.childs[i].visibleelem = false;
                    $scope.removeChildForTeam( $scope.childs[i],$scope.childs[i].lvl,$scope.childs[i].id);
                }
            }
        };
    }
})();