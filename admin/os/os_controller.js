// DBデータ（os_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Os = $resource('os_list.php', {id: '@id'});
  $scope.oss = Os.query();
  
  $scope.add = function() {
    Os.save($scope.new_os, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.os.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.os.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




