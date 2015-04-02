Sl24.controller('MeetingController', ['$scope', '$http',
    function($scope, $http) {
        $scope.meetings = null;
        $scope.meetingsInfo = null;

        $scope.urlGetMeetings = URLS.getMeetings;
        $scope.urlGetMeetingsInfo = URLS.getMeetingsInfo;

        $scope.templateMeetingsAddNew = TEMPLATES.meetingsAddNew;

        $scope.getMeetings = function (user_id) {
            var meetingsUrl = $scope.urlGetMeetings.replace('user_id', user_id);
            $http.get(meetingsUrl)
                .success(function (response) {
                    $scope.meetings = response;
                }
            );
        };
        
        $scope.getMeetingsInfo = function () {
            $http.get($scope.urlGetMeetingsInfo)
                .success(function (response) {
                    $scope.meetingsInfo = response;
                }
            );
        };

        $scope.addNewMeeting = function (meeting) {

        };
    }
]);