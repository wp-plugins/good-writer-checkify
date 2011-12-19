var i = 0;
jQuery(function() {
 
	jQuery('.mark_off_li input:checkbox').click( function() {
		if (jQuery(this).is(':checked')) {
			jQuery(this).siblings("span").css("textDecoration", "line-through");
		} else {
			jQuery(this).siblings("span").css("textDecoration", "none");
		}
   });
   
   jQuery('span#default_checkbox_tip').css({borderBottom: '0px solid #900'}).cluetip({
      splitTitle: '|',
      arrows: true,
      dropShadow: true,
      cluetipClass: 'jtip'}
   );
   
   jQuery('span#random_notes').css({borderBottom: '0px solid #900'}).cluetip({
      splitTitle: '|',
      arrows: true,
      dropShadow: true,
      cluetipClass: 'jtip'}
   );
   jQuery('span#random_notes_2').css({borderBottom: '0px solid #900'}).cluetip({
      splitTitle: '|',
      arrows: true,
      dropShadow: true,
      cluetipClass: 'jtip'}
   );
   
   jQuery('span#show_checkbox_message').css({borderBottom: '0px solid #900'}).cluetip({
      splitTitle: '|',
      arrows: true,
      dropShadow: true,
      cluetipClass: 'jtip'}
   );
   
   
   
  
  jQuery("#toggleShowCheckMarks").click( function() {
    if (jQuery(this).is(':checked')) {
       jQuery(".blog_tip_col_default").css("visibility","visible");
    } else {
      jQuery(".blog_tip_col_default").css("visibility","hidden"); 
    }

  });
  
});