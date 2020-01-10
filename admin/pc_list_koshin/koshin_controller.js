// DBデータ（koshin_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Koshin = $resource('koshin_list.php', {id: '@id'});
  $scope.koshins = Koshin.query();
  
  $scope.add = function() {
    Koshin.save($scope.new_koshin, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.koshin.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.koshin.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




