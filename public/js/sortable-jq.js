$(document).ready(function(){
	$(function() {
                //column profile
		$(".column").sortable({
			connectWith: ".column",
			handle: ".portlet-header",
			cancel: ".portlet-toggle",
			placeholder: "portlet-placeholder"
		});
		$(".portlet")
			.addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
			.find( ".portlet-header" )
			.addClass( "ui-widget-header ui-corner-all" );
		$(".portlet-toggle").click(function() {
			var icon = $( this );
			icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
			icon.closest(".portlet").find(".portlet-content").toggle();
		});
		$("#sortable").sortable({
			//axis: y  -> Solo se mueve sortable en y
			//disabled: true
                        //forzosamente los <li> deben de tener height: auto;
			handle: "#portlet-header",
                        forcePlaceholderSize:true,
                        placeholder: "portlet-placeholder",
                        start: function(e, ui ){
                           //empieza el placeholder
                           ui.placeholder.height(ui.helper.outerHeight()-15);
                           ui.placeholder.width(ui.helper.outerWidth()-15);
                        },
		});
         <!--$("#sortable").disableSelection();-->
	});
});