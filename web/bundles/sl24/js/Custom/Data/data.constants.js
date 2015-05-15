(function () {
    angular.module('Sl24.data')
        .constant('URLS', {
            'asset': TEMP_URLS.asset,

            // Month Routes
            'getMonths': TEMP_URLS.getMonths,
            'addNewMonth': TEMP_URLS.addNewMonth,

            // Article Routes
            'getFullArticle': TEMP_URLS.getFullArticle,
            'getArticles': TEMP_URLS.getArticles,
            'addArticle': TEMP_URLS.addArticle,

            // Meeting Routes
            'getMeetings': TEMP_URLS.getMeetings,
            'getMeeting': TEMP_URLS.getMeeting,
            'saveMeeting': TEMP_URLS.saveMeeting,
            'removeMeeting': TEMP_URLS.removeMeeting,
            'getMeetingsInfo': TEMP_URLS.getMeetingsInfo,
            'addNewMeeting': TEMP_URLS.addNewMeeting,
            'getMeetingPosts': TEMP_URLS.getMeetingPosts,
            'addMeetingPost': TEMP_URLS.addMeetingPost,
            'editMeetingPost': TEMP_URLS.editMeetingPost,

            // User Routes
            'addNewUser': TEMP_URLS.addNewUser,
            'getUserSettings': TEMP_URLS.getUserSettings,
            'saveUserSettings': TEMP_URLS.saveUserSettings,
            'saveNewPass': TEMP_URLS.saveNewPass,
            'userHomepageGetInfo': TEMP_URLS.userHomepageGetInfo,

            // Team Routes
            'getTeam': TEMP_URLS.getTeam,

            // Task Routes
            'getTasks': TEMP_URLS.getTasks,
            'getTask': TEMP_URLS.getTask,
            'getTaskStatuses': TEMP_URLS.getTaskStatuses,
            'saveTaskInfo': TEMP_URLS.saveTaskInfo,
            'addTask': TEMP_URLS.addTask,
            'getTaskPosts': TEMP_URLS.getTaskPosts,
            'addTaskPost': TEMP_URLS.addTaskPost,
            'editTaskPost': TEMP_URLS.editTaskPost,
            'deleteTask': TEMP_URLS.deleteTask
        })
        .constant('TEMPLATES', TEMPLATES);
})();