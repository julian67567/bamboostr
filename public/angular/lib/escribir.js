app.controller('escribirCtrl', function($rootScope, $scope, evt, $filter){
  $rootScope.title = "Escribir una nueva publicación";
  setTimeout(function(){
    $('body').addClass('loaded');
  }, 1000);
});