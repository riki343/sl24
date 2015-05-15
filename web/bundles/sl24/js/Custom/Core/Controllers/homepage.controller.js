(function () {
    angular.module('Sl24').controller('HomepageController', HomepageController);

    HomepageController.$inject = [
        '$scope',
        '$routeParams',
        '$homeOffice'
    ];

    function HomepageController($scope, $routeParams, $homeOffice) {
        $scope.meetings = [];
        $scope.tasks = [];
        $scope.birthdays = [];
        $scope.total = {
            'today': 0,
            'tommorow': 0
        };
        $scope.homeChilds = [];
        $scope.homeUser = {};

        var ownPage = !angular.isDefined($routeParams.consultant_id);
        $scope.ownPage = ownPage;
        $scope.consultant = (!ownPage) ? $routeParams.consultant_id : $scope.userID;

        $scope.getHomeOfficeInfo = function () {
            var promise = $homeOffice.getHomeOfficeInfo($scope.consultant);
            promise.then(function (response) {
                $scope.meetings = response.data.meetings;
                $scope.tasks = response.data.tasks;
                $scope.birthdays = response.data.birthdays;
                $scope.homeChilds = response.data.childs;
                $scope.homeUser = response.data.user;
                $scope.total.today = $scope.meetings.today.length + $scope.tasks.today.length;
                $scope.total.tommorow = $scope.meetings.tommorow.length + $scope.tasks.tommorow.length;
            });
        };
    }
})();

