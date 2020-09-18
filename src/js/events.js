
$(document).ready(function() {

   $(".btn-upcoming").removeClass(".btn").addClass("btn-focus");

   $(".btn-past").click(function(){
       $(".btn-upcoming").addClass(".btn").removeClass("btn-focus");
       $(".btn-past").addClass("btn-focus").removeClass(".btn");
       console.log("ASDASD");
   });
   
    $(".btn-upcoming").click(function(){
        $(".btn-past").addClass(".btn").removeClass(".btn-focus");
        $(".btn-upcoming").addClass(".btn-focus").removeClass(".btn");
        console.log("456345634");
    
});


});