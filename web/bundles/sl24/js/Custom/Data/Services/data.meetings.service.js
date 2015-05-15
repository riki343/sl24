(function () {
    angular.module('Sl24.data')
        .factory('$meetings', meetingsService);

    meetingsService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function meetingsService($http, $q, $spinner, URLS) {

        var meetings = {
            'getMeetings': getMeetings,
            'getMeeting': getMeeting,
            'getMeetingsInfo': getMeetingsInfo,
            'saveMeeting': saveMeeting,
            'removeMeeting': removeMeeting,
            'getMeetingPosts': getMeetingPosts,
            'addMeetingPost': addMeetingPost,
            'editMeetingPost': editMeetingPost,
            'addNewMeeting': addNewMeeting
        };

        return meetings;

        function getMeetings(userID) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getMeetings.replace('user_id', userID));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function getMeeting(id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getMeeting.replace('meeting_id', id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function getMeetingsInfo(id, withoutSpinner) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getMeetingsInfo.replace('user_id', id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            if (withoutSpinner) {
                $spinner.addPromise(promise);
            }
            return deffered.promise;
        }

        function addNewMeeting(id, meeting) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.addNewMeeting.replace('user_id', id), {
                'meeting': meeting
            });
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function saveMeeting(meeting) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.saveMeeting.replace('meeting_id', meeting.id), {
                'meeting': meeting
            });
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function removeMeeting(meeting_id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.removeMeeting.replace('meeting_id', meeting_id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function getMeetingPosts(meeting_id) {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getMeetingPosts.replace('meeting_id', meeting_id));
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function addMeetingPost(meeting_id, post) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.addMeetingPost.replace('meeting_id', meeting_id), {
                'post': post
            });
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }

        function editMeetingPost(post) {
            var deffered = $q.defer();
            var promise = $http.post(URLS.editMeetingPost.replace('post_id', post.id), {
                'post': post
            });
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }
    }
})();