// DBデータ（processor_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var Processor = $resource('processor_list.php', {id: '@id'});
  $scope.processors = Processor.query();
  
  $scope.add = function() {
    Processor.save($scope.new_processor, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.processor.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.processor.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




