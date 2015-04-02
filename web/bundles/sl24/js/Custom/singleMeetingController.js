Sl24.controller('SingleMeetingController', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {
        $scope.meeting = null;
        $scope.meeting_id = $routeParams.meeting_id;
        $scope.meetingsInfo = null;

        $scope.urlGetMeeting = URLS.getMeeting;
        $scope.urlGetMeetingsInfo = URLS.getMeetingsInfo;

        $scope.getMeeting = function (meeting_id) {
            var meetingUrl = $scope.urlGetMeeting.replace('meeting_id', meeting_id);
            $http.get(meetingUrl)
                .success(function (response) {
                    $scope.meeting = response;
                }
            );
        };

        $scope.getMeetingsInfo = function () {
            $http.get($scope.urlGetMeetingsInfo)
                .success(function (response) {
                    $scope.meetingsInfo = response;

                    if ($scope.meetingsInfo.statuses.length > 0) {
                        $scope.meetingForAdd.status = $scope.meetingsInfo.statuses[0].id;
                    }
                    if ($scope.meetingsInfo.assistants.length > 0) {
                        $scope.meetingForAdd.assistants = $scope.meetingsInfo.assistants[0].id;
                    }
                    if ($scope.meetingsInfo.employmentTypes.length > 0) {
                        $scope.meetingForAdd.employmentType = $scope.meetingsInfo.employmentTypes[0].id;
                    }
                }
            );
        };

        $scope.getMeeting($scope.meeting_id);
    }
]);