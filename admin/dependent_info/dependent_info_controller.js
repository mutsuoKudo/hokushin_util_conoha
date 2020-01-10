// DBデータ（dependent_info_list.php）の呼び出し・追加・更新・削除


var app = angular.module('app', ['ngResource']);

app.controller('MainCtrl', function($scope, $resource, $window) {
    // var Student = $resource('students.php', {page: '@page'});
    var Dependent_info = $resource('dependent_info_list.php', { id: '@id' });
    $scope.dependent_infos = Dependent_info.query();

    $scope.add = function() {
        Dependent_info.save($scope.new_dependent_info, function() {
            alert("追加しました。");
            $window.location.reload();
        });
    };
});

app.controller('DetailCtrl', function($scope, $window) {
    $scope.update = function() {
        $scope.dependent_info.$save(function() {
            alert("更新しました。");
            $window.location.reload();
        });
    };

    $scope.delete = function() {
        $scope.dependent_info.$delete();
        alert("削除しました。");
        $window.location.reload();
    };
});