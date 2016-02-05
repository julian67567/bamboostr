var Liip = Liip || {};
Liip.resizer = (function ($) {
    var mainCanvas;

    var init = function () {
        $("#size").change(function() {
          startResize(); 
        });
    };

    var startResize = function () {
        console.log("resize function");
        console.log($("#size").val());
        size = $("#size").val();

        $('#outputImage').attr('src', $("#inputImage").attr("src"));   
        console.log("Input image");
        console.log($("#inputImage").attr("src"));     

        console.log("Output image");
        console.log($("#outputImage").attr("src"));
        
        radioWatermark();

        var canvas = document.createElement("canvas");
        canvas.width = size*$("#inputImage").width();
        canvas.height = size*$("#inputImage").height();
        console.log("Canvas Sizes");
        console.log(canvas.width + " " + canvas.height + " " + $("#inputImage").width() + " " + size);
        var ctx = canvas.getContext("2d");
        ctx.drawImage(document.getElementById("outputImage"), 0, 0, canvas.width, canvas.height);
        $('#outputImage').attr('src', canvas.toDataURL("image/jpeg"));   
        console.log(imageBackWatermark);
        //watermark
        radioWatermark();
    };


    return {
        init: init
    };

})(jQuery);

jQuery(function($) {
    Liip.resizer.init();
});