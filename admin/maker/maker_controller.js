// DBデータ（maker_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Maker = $resource('maker_list.php', {id: '@id'});
  $scope.makers = Maker.query();
  
  $scope.add = function() {
    Maker.save($scope.new_maker, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.maker.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.maker.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




