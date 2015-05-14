(function () {
    angular.module('Sl24.data')
        .factory('$workingMonth', workingMonthService);

    workingMonthService.$inject = [
        '$http',
        '$q',
        '$spinner',
        'URLS'
    ];

    function workingMonthService($http, $q, $spinner, URLS) {

        var workingMonth = {
            'addMonth': addMonth
        };

        return workingMonth;

        function addMonth(month) {
            var promise = $http.post(URLS.addNewMounth, { 'mounth': month });
            promise.then(function () {
                $('#add_new_work_mounth').modal('hide');
            });
            $spinner.addPromise(promise);
        }
    }
})();