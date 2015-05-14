(function () {
    angular.module('Sl24').controller('HomepageController', HomepageController);

    HomepageController.$inject = [
        '$scope',
        '$routeParams',
        '$spinner',
        '$homeOffice'
    ];

    function HomepageController($scope, $routeParams, $spinner, $homeOffice) {
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
                    $scope.meetings = response.meetings;
                    $scope.tasks = response.tasks;
                    $scope.birthdays = response.birthdays;
                    $scope.homeChilds = response.childs;
                    $scope.homeUser = response.user;
                    $scope.total.today = $scope.meetings.today.length
                    + $scope.tasks.today.length;
                    $scope.total.tommorow = $scope.meetings.tommorow.length
                    + $scope.tasks.tommorow.length;
                }
            );
            $spinner.addPromise(promise);
        };
    }
})();

