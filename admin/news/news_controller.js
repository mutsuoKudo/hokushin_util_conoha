// DBデータ（news_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
  // var Student = $resource('students.php', {page: '@page'});
  var News = $resource('news_list.php', {id: '@id'});
  $scope.newss = News.query();
  
  $scope.add = function() {
    News.save($scope.new_news, function() {
      alert("追加しました。");
      $window.location.reload();
    });
  };
});

app.controller('DetailCtrl', function($scope, $window) {
  $scope.update = function() {
    $scope.news.$save(function() {
      alert("更新しました。");
      $window.location.reload();    
    });
  };
  
  $scope.delete = function() {
    $scope.news.$delete();
    alert("削除しました。");
    $window.location.reload();
  };
});




