Sl24.controller('MeetingController', ['$scope', '$http', '$rootScope', '$routeParams',
    function($scope, $http, $rootScope, $routeParams) {
        $scope.meetings = null;
        $scope.meetingsInfo = null;
        $scope.meetingForAdd = {
            'date': new Date(),
            'credentials': null,
            'assistant': null,
            'status': null,
            'employmentType': null
        };

        $scope.mounthForAdd = {
            'name': null,
            'startDate': null,
            'endDate': null
        };

        var ownPage = !angular.isDefined($routeParams.consultant_id);
        $scope.ownPage = ownPage;
        $scope.consultant = (!ownPage) ? $routeParams.consultant_id : null;

        var urlGetMeetings = URLS.getMeetings;
        var urlGetMeetingsInfo = URLS.getMeetingsInfo;
        var urlAddNewMeeting = URLS.addNewMeeting;
        $scope.urlAddNewMounth = URLS.addNewMounth;

        $scope.templateMeetingsAddNew = TEMPLATES.meetingsAddNew;
        $scope.templateMounthAddNew = TEMPLATES.mounthAddNew;

        $scope.getMeetings = function () {
            $rootScope.spinner = true;
            var requestUrl = (ownPage)
                ? urlGetMeetings.replace('user_id', $scope.userID)
                : urlGetMeetings.replace('user_id', $routeParams.consultant_id);
            $http.get(requestUrl)
                .success(function (response) {
                    $scope.meetings = response;
                    $rootScope.spinner = false;
                }
            );
        };

        $scope.getMeetingsInfo = function () {
            var requestUrl = (ownPage)
                ? urlGetMeetingsInfo.replace('user_id', $scope.userID)
                : urlGetMeetingsInfo.replace('user_id', $routeParams.consultant_id);
            $http.get(requestUrl)
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

        $scope.addNewMeeting = function (meeting) {
            $('#add_new_meeting').modal('hide');
            var requestUrl = (ownPage)
                ? urlAddNewMeeting.replace('user_id', $scope.userID)
                : urlAddNewMeeting.replace('user_id', $routeParams.consultant_id);
            $http.post(requestUrl, { 'meeting': meeting })
                .success(function (response) {
                    if (response == 'success') {
                        $scope.getMeetings();
                    }
                }
            );
        };

        $scope.addMounth = function (mounth) {
            if ($scope.mounthForAdd.name != null && $scope.mounthForAdd.startDate != null && $scope.mounthForAdd.endDate != null)
            {
                $rootScope.spinner = true;
                $('#add_new_work_mounth').modal('hide');
                $http.post($scope.urlAddNewMounth, { 'mounth': mounth })
                    .success(function (response) {
                        if (response) {
                            $rootScope.spinner = false;
                        }
                    }
                );
            }
        };
    }
]);