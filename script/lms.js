function openLoader(){
      //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
 
    //Set height and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
     
    //transition effect     
    //$('#mask').fadeIn(0.8);    
    $('#mask').fadeTo("fast",0.6);  
 
    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
           
    //Set the popup window to center
    $('#page_loading').css('top',  winH/2-$('#page_loading').height()/2);
    $('#page_loading').css('left', winW/2-$('#page_loading').width()/2);
 
    //transition effect
    $('#page_loading').fadeIn(2000); 
}
function closeLoader(){
     $('#mask, #page_loading').hide();
}