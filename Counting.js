console.log("Counter.js Script enqueued!");

jQuery(document).ready(function(){
    
    //Description - Words counter
    jQuery("#Result").text(jQuery("#Description").val().length + " Characters");
    jQuery('#Description').on('keyup',function(){
        var charCounter = jQuery(this).val().length;   
        jQuery("#Result").text(charCounter + " Characters");

        //Color Results
        if(charCounter < 140 || charCounter > 160){
            jQuery("#Result").css("color", "red");
        }

        else if(charCounter >= 140 && charCounter < 150){
            jQuery("#Result").css("color", "orange");
        }

        else{
            jQuery("#Result").css("color", "green");
        }
    });
    //Description - Words Counter END
});
