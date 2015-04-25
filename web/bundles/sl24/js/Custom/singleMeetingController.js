Sl24.controller('SingleMeetingController', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {
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
            'posted': null
        };

        $scope.urlGetMeeting = URLS.getMeeting;
        $scope.urlGetMeetingsInfo = URLS.getMeetingsInfo;
        $scope.urlSaveMeeting = URLS.saveMeeting;
        $scope.urlRemoveMeeting =  URLS.removeMeeting;
        $scope.urlGetMeetingPosts = URLS.getMeetingPosts;
        $scope.urlAddMeetingPost = URLS.addMeetingPost;
        $scope.urlEditMeetingPost = URLS.editMeetingPost;

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
                        location.href = '/consultant/meetings'
                    }
                }
            );
        };

        function preparePosts(posts) {
            for (var i = 0; i < posts.length; i++) {
                posts[i].edit = false;
            }
            return posts;
        }

        $scope.getPosts = function () {
            $scope.meetingPromise = $http
                .get($scope.urlGetMeetingPosts.replace('meeting_id', $scope.meeting_id))
                .success(function (response) {
                    $scope.posts = preparePosts(response);
                }
            );
        };

        function addPost(post) {
            $scope.meetingPromise = $http
                .post($scope.urlAddMeetingPost.replace('meeting_id', $scope.meeting_id, { 'post': post }))
                .success(function (response) {
                    if (!$scope.posts) {
                        $scope.posts = [];
                    }
                    response.edit = false;
                    $scope.posts.push(response);
                }
            );
        }

        function editPost(post) {
            $scope.meetingPromise = $http
                .post($scope.urlEditMeetingPost.replace('post_id', post.id, { 'post': post }))
                .success(function (response) {
                    response.edit = false;
                    for (var i = 0; i < $scope.post.length; i++) {
                        if ($scope.posts[i].id == response.id) {
                            $scope.posts[i] = response;
                            break;
                        }
                    }
                }
            );
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

    }
]);