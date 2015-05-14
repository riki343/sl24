(function () {
    angular.module('Sl24').controller('MeetingController', MeetingController);

    MeetingController.$inject = [
        '$scope',
        '$http',
        '$rootScope',
        '$spinner'
    ];

    function MeetingController($scope, $http, $routeParams, $spinner) {
        $scope.meetings = null;
        $scope.meetingsInfo = null;
        $scope.meetingForAdd = {
            'date': new Date(),
            'credentials': null,
            'assistant': null,
            'status': null,
            'employmentType': null
        };

        var ownPage = !angular.isDefined($routeParams.consultant_id);
        $scope.ownPage = ownPage;
        $scope.consultant = (!ownPage) ? $routeParams.consultant_id : null;

        var urlGetMeetings = URLS.getMeetings;
        var urlGetMeetingsInfo = URLS.getMeetingsInfo;
        var urlAddNewMeeting = URLS.addNewMeeting;

        $scope.templateMeetingsAddNew = TEMPLATES.meetingsAddNew;

        $scope.getMeetings = function () {
            var requestUrl = (ownPage)
                ? urlGetMeetings.replace('user_id', $scope.userID)
                : urlGetMeetings.replace('user_id', $routeParams.consultant_id);
            var promise = $http.get(requestUrl)
                .success(function (response) {
                    $scope.meetings = response;
                }
            );
            $spinner.addPromise(promise);
        };

        $scope.getMeetingsInfo = function () {
            var requestUrl = (ownPage)
                ? urlGetMeetingsInfo.replace('user_id', $scope.userID)
                : urlGetMeetingsInfo.replace('user_id', $routeParams.consultant_id);
            var promise = $http.get(requestUrl)
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
            $spinner.addPromise(promise);
        };

        $scope.addNewMeeting = function (meeting) {
            $('#add_new_meeting').modal('hide');
            var requestUrl = (ownPage)
                ? urlAddNewMeeting.replace('user_id', $scope.userID)
                : urlAddNewMeeting.replace('user_id', $routeParams.consultant_id);
            var promise = $http.post(requestUrl, { 'meeting': meeting })
                .success(function (response) {
                    if (response == 'success') {
                        $scope.getMeetings();
                    }
                }
            );
            $spinner.addPromise(promise);
        };
    }
})();