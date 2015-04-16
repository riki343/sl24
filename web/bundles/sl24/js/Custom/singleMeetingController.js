Sl24.controller('SingleMeetingController', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {
        $scope.meeting = null;
        $scope.meeting_id = $routeParams.meeting_id;
        $scope.meetingsInfo = null;

        $scope.urlGetMeeting = URLS.getMeeting;
        $scope.urlGetMeetingsInfo = URLS.getMeetingsInfo;
        $scope.urlSaveMeeting = URLS.saveMeeting;
        $scope.urlRemoveMeeting =  URLS.removeMeeting;

        $scope.getMeeting = function (meeting_id) {
            var meetingUrl = $scope.urlGetMeeting.replace('meeting_id', meeting_id);
            $scope.meetingPromise = $http.get(meetingUrl)
                .success(function (response) {
                    $scope.meeting = response;
                    $scope.meetingEdit = angular.copy(response);
                    $scope.meetingEdit.date = new Date($scope.meeting.date);
                    $scope.meetingEdit.payDate = new Date($scope.meeting.payDate);
                    $scope.meetingEdit.clientBirthday.date = new Date($scope.meeting.clientBirthday.date);
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

        $scope.saveMeeting = function (meeting) {
            var saveMeetingUrl = $scope.urlSaveMeeting.replace('meeting_id', meeting.id);
            $http.post(saveMeetingUrl, { 'meeting': meeting })
                .success(function (response) {
                    if (response) {
                        $scope.modalHeader = 'Успішно';
                        $scope.modalBody = 'Інформація про зустріч успішно збережена.';
                    } else {
                        $scope.modalHeader = 'Помилка';
                        $scope.modalBody = 'Невідома помилка.';
                    }
                    $('#edit_meeting').modal('show');
                }
            );
        };
        $scope.removeMeeting = function (id) {
            var removeMeetingUrl = $scope.urlRemoveMeeting.replace('meeting_id', id);
            $http.get(removeMeetingUrl)
                .success(function (response) {
                    if(response)
                    {
                        location.href = '/meetings'
                    }
                }
            );
        }

    }
]);