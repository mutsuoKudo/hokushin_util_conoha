// DBデータ（jyotai_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Jyotai = $resource('jyotai_list.php', {id: '@id'});
  $scope.jyotais = Jyotai.query();
  
  $scope.add = function() {
    Jyotai.save($scope.new_jyotai, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.jyotai.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.jyotai.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




