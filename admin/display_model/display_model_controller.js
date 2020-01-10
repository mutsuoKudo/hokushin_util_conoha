// DBデータ（display_model_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Display_model = $resource('display_model_list.php', {id: '@id'});
  $scope.display_models = Display_model.query();
  
  $scope.add = function() {
    Display_model.save($scope.new_display_model, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.display_model.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.display_model.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




