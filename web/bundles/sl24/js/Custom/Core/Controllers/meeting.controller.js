(function () {
    angular.module('Sl24').controller('MeetingController', MeetingController);

    MeetingController.$inject = [
        '$scope',
        '$routeParams',
        '$meetings',
        'TEMPLATES'
    ];

    function MeetingController($scope, $routeParams, $meetings, TEMPLATES) {
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

        $scope.templateMeetingsAddNew = TEMPLATES.meetingsAddNew;

        $scope.getMeetings = function () {
            var id = (ownPage) ? $scope.userID : $routeParams.consultant_id;
            var promise = $meetings.getMeetings(id);
            promise.then(function (response) {
                $scope.meetings = response.data;
            });
        };

        $scope.getMeetingsInfo = function () {
            var id = (ownPage) ? $scope.userID : $routeParams.consultant_id;
            var promise = $meetings.getMeetingsInfo(id);
            promise.then(function (response) {
                $scope.meetingsInfo = response.data;
                if ($scope.meetingsInfo.statuses.length > 0) {
                    $scope.meetingForAdd.status = $scope.meetingsInfo.statuses[0].id;
                }
                if ($scope.meetingsInfo.assistants.length > 0) {
                    $scope.meetingForAdd.assistants = $scope.meetingsInfo.assistants[0].id;
                }
                if ($scope.meetingsInfo.employmentTypes.length > 0) {
                    $scope.meetingForAdd.employmentType = $scope.meetingsInfo.employmentTypes[0].id;
                }
            });
        };

        $scope.addNewMeeting = function (meeting) {
            $('#add_new_meeting').modal('hide');
            var id = (ownPage) ? $scope.userID : $routeParams.consultant_id;
            var promise = $meetings.addNewMeeting(id, meeting);
            promise.then(function (response) {
                if (response.data == 'success') {
                    $scope.getMeetings();
                }
            });
        };
    }
})();