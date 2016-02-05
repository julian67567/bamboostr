function help(option, red){
   $("#help").dialog("open");
   $("#help").dialog('option', 'width', 350);
   $("#help").dialog('option', 'title', txt48);
   var htmlAyuda = '';
	  htmlAyuda += '<div style="width: 100%; text-align: center;">';
   if(red=="facebook"){
	 if(option==1){
	   htmlAyuda += txt158;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt159;
	 } else if(option==2){
	   htmlAyuda += txt160;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt161;
	 } else if(option==3){
	   htmlAyuda += txt162;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt163;
	 } else if(option==4){
	   htmlAyuda += txt164;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt165;
	 } else if(option==5){
				   htmlAyuda += txt313;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt314;
	 }
   } else if(red=="twitter"){
	 if(option==1){
				   htmlAyuda += txt166;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt167;
	 } else if(option==2){
				   htmlAyuda += txt168;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt169;

	 } else if(option==3){
				   htmlAyuda += txt170;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt171;
	 } else if(option==4){
				   htmlAyuda += txt172;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt173;
	 }
   } else if(red=="msgsProgramados"){
	 htmlAyuda += txt174;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt175;
   } else if(red=="drafts"){
	 htmlAyuda += txt176;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt177;
   } else if(red=="agregar"){
	 htmlAyuda += txt188;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt189;
   } else if(red=="configuracion"){
	 htmlAyuda += txt191;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt192;
   } else if(red=="profile"){
     if(option==1){
	 htmlAyuda += txt223;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt224;
     }
     if(option==2){
	 htmlAyuda += txt225;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt226;
     }
   } else if(red=="faPageStatistics"){
     if(option==1){
	 htmlAyuda += txt238;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt252;
     }
     if(option==2){
	 htmlAyuda += txt239;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt253;
     }
     if(option==3){
	 htmlAyuda += txt240;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt254;
     }
     if(option==4){
	 htmlAyuda += txt241;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt255;
     }
     if(option==5){
	 htmlAyuda += txt242;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt256;
     }
     if(option==6){
	 htmlAyuda += txt243;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt257;
     }
     if(option==7){
	 htmlAyuda += txt245;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt258;
     }
     if(option==8){
	 htmlAyuda += txt246;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt259;
     }
     if(option==9){
	 htmlAyuda += txt247;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt260;
     }
     if(option==10){
	 htmlAyuda += txt248;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt261;
     }
     if(option==11){
	 htmlAyuda += txt249;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt262;
     }
     if(option==12){
	 htmlAyuda += txt244;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt263;
     }
   } else if(red=="faStatistics"){
     if(option==1){
	 htmlAyuda += txt229;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt277;
     }
     if(option==2){
	 htmlAyuda += txt230;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt278;
     }
     if(option==3){
	 htmlAyuda += txt234;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt279;
     }
     if(option==4){
	 htmlAyuda += txt231;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt280;
     }
     if(option==5){
	 htmlAyuda += txt235;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt281;
     }
     if(option==6){
	 htmlAyuda += txt232;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt282;
     }
     if(option==7){
	 htmlAyuda += txt236;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt283;
     }
     if(option==8){
	 htmlAyuda += txt233;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt284;
     }
     if(option==9){
	 htmlAyuda += txt237;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt285;
     }	   
   } else if(red=="twitterStatistics"){
     if(option==1){
	 htmlAyuda += txt93.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt266;
     }
     if(option==2){
	 htmlAyuda += txt94.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt267;
     }
     if(option==3){
	 htmlAyuda += txt95.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt268;
     }
     if(option==4){
	 htmlAyuda += txt96.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt269;
     }
     if(option==5){
	 htmlAyuda += txt102;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt270;
     }
     if(option==6){
	 htmlAyuda += txt97.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt271;
     }
     if(option==7){
	 htmlAyuda += txt98.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt272;
     }
     if(option==8){
	 htmlAyuda += txt99.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt273;
     }
     if(option==9){
	 htmlAyuda += txt100.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt274;
     }
     if(option==10){
	 htmlAyuda += txt265;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt275;
     }
     if(option==11){
	 htmlAyuda += txt228;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt276;
     }
   } else if(red=="faTools"){
     if(option==1){
       htmlAyuda += '';
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += '';
     }
   } else if(red=="twTools"){
     if(option==1){
       htmlAyuda += txt286;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt302;
     }
     if(option==2){
       htmlAyuda += txt217;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt303;
     }
     if(option==4){
        htmlAyuda += txt97.substr(9);
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt305;
     }
     if(option==5){
        htmlAyuda += txt195;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt306;
     }
     if(option==7){
        htmlAyuda += txt199;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt308;
     }
   } else if(red=="faShare"){
     if(option==1){
       htmlAyuda += txt328;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt329;
     }
  }
  htmlAyuda += ''+txt334+'</div>';
	 htmlAyuda += '</div>';
   $("#help").html(htmlAyuda);
}
function helpEscribir(option, red){
  $("#help").dialog("open");
  $("#help").dialog('option', 'width', 350);
  $("#help").dialog('option', 'title', txt48);
  var htmlAyuda = '';
     htmlAyuda += '<div style="width: 100%; text-align: center;">';
     if(red=="agendar"){
       htmlAyuda += txt178;
         htmlAyuda += '<div style="width: 100%; text-align: left;">';
           htmlAyuda += txt179;
     }
     if(red=="adjuntar"){
       htmlAyuda += txt180;
         htmlAyuda += '<div style="width: 100%; text-align: left;">';
           htmlAyuda += txt181;
     }
     if(red=="publicar"){
       htmlAyuda += txt182;
         htmlAyuda += '<div style="width: 100%; text-align: left;">';
           htmlAyuda += txt183;
     }
     if(red=="perfilesNum"){
       htmlAyuda += txt328;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt329;
     }  
     if(red=="acortar"){
       htmlAyuda += txt330;
		 htmlAyuda += '<div style="width: 100%; text-align: left;">';
		   htmlAyuda += txt331;
     }
     if(red=="escribirNum"){
       if(option==1){
         htmlAyuda += txt332;
		   htmlAyuda += '<div style="width: 100%; text-align: left;">';
		     htmlAyuda += txt333;
       } else if(option==2){
         htmlAyuda += txt412;
		   htmlAyuda += '<div style="width: 100%; text-align: left;"><br />';
		     htmlAyuda += txt216;
       } else if(option==3){
         htmlAyuda += txt332;
		   htmlAyuda += '<div style="width: 100%; text-align: left;"><br />';
		     htmlAyuda += txt411;
       }
     }
         htmlAyuda += ''+txt334+'</div>';
     htmlAyuda += '</div>';
     $("#help").html(htmlAyuda);
}