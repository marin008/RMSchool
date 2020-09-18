
$(document).ready(function() {

   $(".btn-upcoming").removeClass(".btn").addClass("btn-focus");
   $(".event-card-upcoming").show();
   $(".event-card-past").hide();

   $(".btn-past").click(function(){
       $(".btn-upcoming").addClass(".btn").removeClass("btn-focus");
       $(".btn-past").addClass("btn-focus").removeClass(".btn");
       $(".event-card-upcoming").slideUp(500);
       $(".event-card-past").slideDown(500);
    
   });
   
    $(".btn-upcoming").click(function(){
        $(".btn-past").addClass(".btn").removeClass("btn-focus");
        $(".btn-upcoming").addClass(".btn-focus").removeClass(".btn");
        $(".event-card-past").slideUp(500);
        $(".event-card-upcoming").slideDown(500);
    
    });


});