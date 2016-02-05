function rastrear(option2) {
  $.ajax({      data: { id_token:id_token, option:"rastreo", option2:option2},
                url:   "thread-sys.php",
		type:  'GET',
		success:  function (response) {
                }, error: function (response){
		}
  });
}