jQuery(document).ready(function(){
   
  /*start value*/
  var oglocale = jQuery("#Oglocale").val();
  jQuery('#DropdownLocale option[value="'+ oglocale +'"]').attr('selected', 'selected');

  var ogType = jQuery("#Ogtype").val();
  jQuery('#DropdownType option[value="'+ ogType +'"]').attr('selected', 'selected');
  /**/

    /*Select Locale */
    jQuery('#DropdownLocale').on('change', function() {     
        jQuery("#Oglocale").val(this.value);
    });
    /**/

    /*Select Type */
    jQuery('#DropdownType').on('change', function() {     
      jQuery("#Ogtype").val(this.value);
  });
  /**/

    /*Add Locale*/
    jQuery("#addLocale").click(function(){
        jQuery("#Oglocale").css("display","inline-block"); 
    });
    /**/

    /*Add Type*/
    jQuery("#addType").click(function(){
      jQuery("#Ogtype").css("display","inline-block"); 
    });
    /**/

    /*Copy Description*/
    jQuery("#copyDescription").click(function(){
      jQuery("#Ogdescription").text(jQuery("#copyText").val());
      jQuery("#copyDescription").val("copied!");
      jQuery("#copyDescription").css("border-color","#06dd06");
    });
    /**/

    /*Select Image*/
    var mediaUploader;

    jQuery('#OgImageSelect').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });
  
      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        var attachment = mediaUploader.state().get('selection').first().toJSON();
        jQuery('#Ogimage').val(attachment.url);
      });
      // Open the uploader dialog
      mediaUploader.open();
    });
});
