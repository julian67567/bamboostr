app.factory('evt',function($http){
	return{
		size:function(dataObject){
			var i=0;
			$.each(dataObject, function(key, value){
				i++;
			});
			return i;
		},
        actualizarDetails:function(username, nombre, mail, categoria, password, image, option){
            var url = 'scripts/actualizar-details.php';
			return $http.get(url, {cache: false, params: { image:image, id_token:id_token, username:username, nombre:nombre, mail:mail, categoria:categoria, password:password, option:option } })
	    },
        payOption:function(){
            var url = 'payOption';
			return $http.post(url, {cache: false, params: { id_token:id_token } })
	    },
        getDetails:function(){
            var url = 'scripts/get-details.php';
			return $http.get(url, { cache: false, params: { id_token:id_token } })
	    },
        sendDmsFacebook:function(x, txt){
            var url = 'facebook/thread-fa.php';
			return $http.get(url, { cache: false, params: { id_message:x.id_message, message: txt, option: 'postInbox', identify: x.identify_recipient } })
	    },
        sendDmsTwitter:function(x, txt){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { text: txt, dm_name: x.screen_name, option: 'sendDmsTwitter', screen_name: x.propietario2_screen_name } })
	    },
        eliminardms:function(x, option){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token:x.id_token, id: x.id, option: 'eliminarDm', option2: option } })
	    },
		getCuentas:function(){
            var url = 'thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token: id_token, identify: identify, option: 'getCuentas' } })
	    },
		setDMS:function(){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token: id_token, identify: identify, option: 'setDMSCon' } })
	    },
		setDMSTwitter:function(idensdds){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token: id_token, identify: idensdds, option: 'setDMSTwitter' } })
	    },
        setDMSFacebook:function(idensdds){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token: id_token, identify: idensdds, option: 'setDMSFacebook' } })
	    },
		setDMSFacebook2:function(idensdds,x){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token: id_token, identify: idensdds, option: 'setDMSFacebook', identify_sender: x.identify_sender } })
	    },
	    getDMS:function(){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id_token: id_token, option: 'getDMS' } })
	    },
	    setPinDMS:function(x, est){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { id: x.id, id_token: id_token, option: 'setPinDMS', est:est } })
	    },
	    getConversation:function(x){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { identify_sender: x.identify_sender, identify_recipient: x.identify_recipient, id_token: id_token, option: 'getConversation', red: x.red} })
	    },
		setReadDMS:function(x){
            var url = 'scripts/responder/thread-sys.php';
			return $http.get(url, { cache: false, params: { identify: x.identify_sender, id_token: id_token, option: 'setReadDMS'} })
	    },
		getNotificationsMessages:function(){
            var url = "thread-sys.php?identify="+identify+"&red="+red+"&option=notificaciones&option3="+2+"&id_token="+id_token+"";
			return $http.get(url, { cache: false })
	    },
        getNotificationsMessages2:function(){
            var url = "thread-sys.php?identify="+identify+"&red="+red+"&option=notificaciones&option3="+3+"&id_token="+id_token+"";
			return $http.get(url, { cache: false })
	    },
		readNotifications:function(id){
            var url = "scripts/leidoNotificacion.php";
			return $http.post(url, { cache: false, params: { id:id} })
	    },
	};
});