// DBデータ（display_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Display = $resource('display_list.php', {id: '@id'});
  $scope.displays = Display.query();
  
  $scope.add = function() {
    Display.save($scope.new_display, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.display.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.display.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




