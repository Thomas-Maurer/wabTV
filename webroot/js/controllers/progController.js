app.controller('progController', ['$scope', 'socket', '$http', '$q', 'serverUrl', '$sce', function($scope, socket, $http, $q, serverUrl, $sce) {
    $scope.calendar = [];

    $scope.init = function () {
        var defer = $q.defer();
        $scope.getProgInfo().then(function (data){
            if (data.data !== null && data.data !== undefined) {
                $scope.prog = data.data;
                defer.resolve(true);
            }
        });
        return defer.promise;
    };


    $scope.getProgInfo = function () {
        var defer = $q.defer();
        $http({
            method: 'GET',
            url: '/getprog'
        }).then(function successCallback(response) {
            defer.resolve(response);
        }, function errorCallback(response) {
            defer.resolve(response);
        });
        return defer.promise;
    };

    $scope.init().then(function (data) {
        angular.forEach($scope.prog, function (day, key) {
            $scope.calendar[key] = day;
        });


    });
}]);
