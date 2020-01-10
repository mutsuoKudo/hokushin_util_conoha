// DBデータ（model_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Model = $resource('model_list.php', {id: '@id'});
  $scope.models = Model.query();
  
  $scope.add = function() {
    Model.save($scope.new_model, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.model.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.model.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




