// DBデータ（room_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
    // var Student = $resource('students.php', {page: '@page'});
    var Room = $resource('room_list.php', { id: '@id' });
    $scope.rooms = Room.query();

    $scope.add = function() {
        Room.save($scope.new_room, function() {
            alert("追加しました。");
            $window.location.reload();
        });
    };
});

app.controller('DetailCtrl', function($scope, $window) {
    $scope.update = function() {
        $scope.room.$save(function() {
            alert("更新しました。");
            $window.location.reload();
        });
    };

    $scope.delete = function() {
        $scope.room.$delete();
        alert("削除しました。");
        $window.location.reload();
    };
});