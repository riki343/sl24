Sl24.controller('MeetingController', ['$scope', '$http',
    function($scope, $http) {
        $scope.meetings = null;
        $scope.test = "SomeTestVariable";

        $scope.getMeetings = function (month_id) {

            $http.get('#')
                .success(function (response) {
                    $scope.meetings = response.meetings;
                }
            );
        };
    }
]);