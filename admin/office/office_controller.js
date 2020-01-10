// DBデータ（office_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Office = $resource('office_list.php', {id: '@id'});
  $scope.offices = Office.query();
  
  $scope.add = function() {
    Office.save($scope.new_office, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.office.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.office.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




