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
            'addMonth': addMonth,
            'getMonths': getMonths
        };

        return workingMonth;

        function addMonth(month) {
            var promise = $http.post(URLS.addNewMonth, { 'mounth': month });
            promise.then(function () {
                $('#add_new_work_mounth').modal('hide');
            });
            $spinner.addPromise(promise);
        }

        function getMonths() {
            var deffered = $q.defer();
            var promise = $http.get(URLS.getMonths);
            promise.then(function (data) {
                deffered.resolve(data);
            });
            $spinner.addPromise(promise);
            return deffered.promise;
        }
    }
})();