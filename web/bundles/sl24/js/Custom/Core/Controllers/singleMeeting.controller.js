(function () {
    angular.module('Sl24').controller('SingleMeetingController', SingleMeetingController);

    SingleMeetingController.$inject = [
        '$scope',
        '$routeParams',
        '$meetings',
        '$location'
    ];

    function SingleMeetingController($scope, $routeParams, $meetings, $location) {
        $scope.meeting = null;
        if (angular.isDefined($routeParams.meeting_id)) {
            $scope.meeting_id = $routeParams.meeting_id;
        } else {
            location.href = '/consultant'
        }
        $scope.meetingsInfo = null;
        $scope.posts = null;
        $scope.post = {
            'id': null,
            'user': null,
            'meetingID': null,
            'message': '',
            'posted': null,
            'edit': false
        };

        var ownPage = !angular.isDefined($routeParams.consultant_id);
        $scope.ownPage = ownPage;
        $scope.consultant = (!ownPage) ? $routeParams.consultant_id : null;

        function preparePosts(posts) {
            for (var i = 0; i < posts.length; i++) {
                posts[i].edit = false;
            }
            return posts;
        }

        $scope.sendPost = function (post) {
            if (post.edit) {
                editPost(post);
            } else {
                addPost(post);
            }
        };

        $scope.enterButton = function (e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                if ($scope.post.edit) {
                    editPost($scope.post);
                } else {
                    addPost($scope.post);
                }
            }
        };

        $scope.getMeeting = function (meeting_id) {
            var promise = $meetings.getMeeting(meeting_id);
            promise.then(function (response) {
                response = response.data;
                $scope.meeting = response;
                $scope.meetingEdit = angular.copy(response);
                $scope.meetingEdit.date = new Date($scope.meeting.date);
                $scope.meetingEdit.payDate = new Date($scope.meeting.payDate);
                $scope.meetingEdit.clientBirthday.date = new Date($scope.meeting.clientBirthday.date);
                $scope.meetingEdit.meetingDate = new Date($scope.meetingEdit.meetingDate);
            });
        };

        $scope.getMeetingsInfo = function () {
            var id = (ownPage) ? $scope.userID : $routeParams.consultant_id;
            var promise = $meetings.getMeetingsInfo(id, true);
            promise.then(function (response) {
                $scope.meetingsInfo = response.data;
            });
        };

        $scope.saveMeeting = function (meeting) {
            $meetings.saveMeeting(meeting);
        };

        $scope.removeMeeting = function (meeting_id) {
            var promise = $meetings.removeMeeting(meeting_id);
            promise.then(function (response) {
                if(response.data) {
                    $location.path('/consultant/meetings');
                }
            });
        };

        $scope.getPosts = function () {
            var promise = $meetings.getMeetingPosts($scope.meeting_id);
            promise.then(function (response) {
                $scope.posts = preparePosts(response.data);
            });
        };

        function addPost(post) {
            var promise = $meetings.addMeetingPost($scope.meeting_id, post);
            promise.then(function (response) {
                    response = response.data;
                    if (!$scope.posts) {
                        $scope.posts = [];
                    }
                    $scope.post.message = "";
                    response.edit = false;
                    $scope.posts.push(response);
            });
        }

        function editPost(post) {
            var promise = $meetings.editMeetingPost(post);
            promise.then(function (response) {
                response = response.data;
                response.edit = false;
                for (var i = 0; i < $scope.post.length; i++) {
                    if ($scope.posts[i].id == response.id) {
                        $scope.posts[i] = response;
                        break;
                    }
                }
            });
        }
    }
})();