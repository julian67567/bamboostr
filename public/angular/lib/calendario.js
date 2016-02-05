app.controller('calendarioCtrl', function($rootScope, $scope, evt, $filter){
  $rootScope.title = "Calendario de Publicaciones";
  setTimeout(function(){
    $('body').addClass('loaded');
  }, 3000);
});