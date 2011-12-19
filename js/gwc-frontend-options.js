var i = 0;
jQuery(function() {
  
   alert("asd");
   jQuery('.mark_off_li input:checkbox').click( function() {
   alert("asd");
       jQuery(this).sibling("span").css("textDecoration", "line-through");
   });
  
});