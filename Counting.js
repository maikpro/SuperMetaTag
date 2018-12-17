console.log("Script enqueued!");

jQuery(document).ready(function(){
    jQuery("#Result").text(jQuery("#Description").val().length);
    jQuery('#Description').on('keyup',function(){
       var charCounter = jQuery(this).val().length;
       jQuery("#Result").text(charCounter);

       if(charCounter <= 140 && charCounter > 160){
            jQuery("#Result").css("color", "red");
       }
    });
});