(function () {
    angular.module('Sl24').controller('AppController', AppController);

    AppController.$inject = [
        '$scope',
        '$spinner'
    ];

    function AppController($scope, $spinner) {

        var self = this;
        this.watches = new Date();

        $scope.userID = USER_ID;
        $scope.userLevel = USER_LEVEL;
        this.spinner = false;

        $spinner.onPromisesStart($scope, function () {
            self.spinner = true;
        });

        $spinner.onPromisesEnd($scope, function () {
            self.spinner = false;
        });

        setInterval(function () {
            $scope.$apply(function () {
                self.watches = new Date();
            });
        }, 1000);
    }
})();