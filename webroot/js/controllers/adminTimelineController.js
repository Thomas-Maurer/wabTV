app.controller('adminTimelineController', ['$scope', '$http', '$q', function($scope, $http, $q) {

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
  
  $scope.update = function () {
    $http({
      method: 'POST',
      data: angular.toJson($scope.prog),
      url: 'updateProg'
    }).then(function successCallback(response) {
      console.log('Modification effectuée !');
    }, function errorCallback(response) {
      console.log('Modification non effectuée !');
    });
  };




}]);
