// DBデータ（bumon_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
    var Bumon = $resource('bumon_list.php', { id: '@id' });
    $scope.bumons = Bumon.query();

    $scope.add = function() {
        Bumon.save($scope.new_bumon, function() {
            alert("追加しました。");
            $window.location.reload();
        });
    };
});

app.controller('DetailCtrl', function($scope, $window) {
    $scope.update = function() {
        $scope.bumon.$save(function() {
            alert("更新しました。");
            $window.location.reload();
        });
    };

    $scope.delete = function() {
        $scope.bumon.$delete();
        alert("削除しました。");
        $window.location.reload();
    };
});