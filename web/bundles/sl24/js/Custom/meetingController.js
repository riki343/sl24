Sl24.controller('MeetingController', ['$scope', '$http',
    function($scope, $http) {
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

        $scope.urlGetMeetings = URLS.getMeetings;
        $scope.urlGetMeetingsInfo = URLS.getMeetingsInfo;
        $scope.urlAddNewMeeting = URLS.addNewMeeting;
        $scope.urlAddNewMounth = URLS.addNewMounth;

        $scope.templateMeetingsAddNew = TEMPLATES.meetingsAddNew;
        $scope.templateMounthAddNew = TEMPLATES.mounthAddNew;

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
            $http.post($scope.urlAddNewMeeting, { 'meeting': meeting })
                .success(function (response) {
                    console.log(response);
                    if (response == 'success') {
                        $scope.getMeetings($scope.userID);
                    }
                }
            );
        };

        $scope.addMounth = function (mounth) {
            if ($scope.mounthForAdd.name != null && $scope.mounthForAdd.startDate != null && $scope.mounthForAdd.endDate != null)
            {
                $('#add_new_work_mounth').modal('hide');
                $http.post($scope.urlAddNewMounth, { 'mounth': mounth })
                    .success(function (response) {
                        if (response) {
                            $scope.modalHeader = 'Успішно';
                            $scope.modalBody = 'Новий робочий місяць додано.';
                        } else {
                            $scope.modalHeader = 'Помилка';
                            $scope.modalBody = 'Невідома помилка.';
                        }
                        $('#new_mounth').modal('show');
                    }
                );
            }
        };
    }
]);