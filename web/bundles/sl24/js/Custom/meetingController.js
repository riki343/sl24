Sl24.controller('MeetingController', ['$scope', '$http',
    function($scope, $http) {
        $scope.meetings = null;
        $scope.test = "SomeTestVariable";

        $scope.urlGetMeetings = URLS.getMeetings;

        $scope.getMeetings = function (user_id) {
            var meetingsUrl = $scope.urlGetMeetings.replace('user_id', user_id);
            $http.get(meetingsUrl)
                .success(function (response) {
                    $scope.meetings = response;
                }
            );
        };

        $scope.getMeetings(1);
    }
]);