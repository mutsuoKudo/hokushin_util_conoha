// DBデータ（pc_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Pc = $resource('pc_list.php', {id: '@id'});
  $scope.pcs = Pc.query();
  
  $scope.add = function() {
    Pc.save($scope.new_pc, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.pc.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.pc.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




