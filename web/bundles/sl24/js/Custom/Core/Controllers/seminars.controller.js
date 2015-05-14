(function () {
    angular.module('Sl24').controller('SeminarsController', SeminarsController);

    SeminarsController.$inject = [
        '$scope',
        '$workingMonth',
        'TEMPLATES'
    ];

    function SeminarsController($scope, $workingMonth, TEMPLATES) {
        $scope.templateMounthAddNew = TEMPLATES.mounthAddNew;
        $scope.monthForAdd = {
            'name': null,
            'startDate': null,
            'endDate': null
        };

        $scope.addMonth = function (month) {
            if ($scope.monthForAdd.name && $scope.monthForAdd.startDate && $scope.monthForAdd.endDate) {
                $workingMonth.addMonth(month);
            }
        };
    }
})();