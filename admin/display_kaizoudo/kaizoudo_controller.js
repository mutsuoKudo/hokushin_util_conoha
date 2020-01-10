// DBデータ（kaizoudo_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Kaizoudo = $resource('kaizoudo_list.php', {id: '@id'});
  $scope.kaizoudos = Kaizoudo.query();
  
  $scope.add = function() {
    Kaizoudo.save($scope.new_kaizoudo, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.kaizoudo.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.kaizoudo.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




