// DBデータ（shain_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
    // var Student = $resource('students.php', {page: '@page'});
    // var Shain = $resource('shain_list.php', {shain_cd: '@shain_cd'});
    var Shain = $resource('shain_list.php', { shain_cd: '@shain_cd' });
    $scope.shains = Shain.query();

    $scope.add = function() {
        Shain.save($scope.new_shain, function() {
            alert("追加しました。");
            $window.location.reload();
        });
    };
});

app.controller('DetailCtrl', function($scope, $window) {
    // $scope.update = function() {
    //   $scope.shain.$save(function() {
    //     alert("更新しました。");
    //     $window.location.reload();    
    //   });
    // };

    $scope.delete = function() {
        $scope.shain.$delete();
        alert("削除しました。");
        $window.location.reload();
    };
});