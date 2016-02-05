app = angular.module('app',['ngSanitize']);
app.controller('titleCtrl', function($rootScope, $scope, evt){
    $rootScope.title = "Bienvenido " + screen_name_bamboostr;
});