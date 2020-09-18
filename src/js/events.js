
$(document).ready(function() {

   $(".btn-upcoming").removeClass(".btn").addClass("btn-focus");
   $(".event-card-upcoming").show();

   $(".btn-past").click(function(){
       $(".btn-upcoming").addClass(".btn").removeClass("btn-focus");
       $(".btn-past").addClass("btn-focus").removeClass(".btn");
       $(".event-card-upcoming").slideToggle(100);
       $(".event-card-past").slideToggle(100);

   });
   
    $(".btn-upcoming").click(function(){
        $(".btn-past").addClass(".btn").removeClass("btn-focus");
        $(".btn-upcoming").addClass(".btn-focus").removeClass(".btn");
        $(".event-card-past").slideToggle(100);
        $(".event-card-upcoming").slideToggle(100);
    
});


});