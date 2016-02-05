app.controller('systemCtrl', function($scope, evt){
  setTimeout(function(){
    $('body').addClass('loaded');
  }, 1000);
});