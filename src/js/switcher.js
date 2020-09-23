$(document).ready(function () {
    $(".articleOne").addClass("selected");
    $(".switchOne").addClass("active-switch");

    var switching = false;

    /////////////Switch one/////////////

    $(".switchOne").click(function (e) { 
        e.preventDefault();

        if(switching) {
            return;
        };

        switching = true;

        $(".article").each(function(){
            $(this).fadeOut(500);
        }); 
        
        $(".switch").each(function(){
            $(this).removeClass("active-switch");
        });

        $(".articleOne").delay(500).fadeIn(500);
        $(".switchOne").addClass("active-switch");
        setTimeout(function() {
            switching = false;
        }, 1000);
 
    });

    /////////////Switch two/////////////

    $(".switchTwo").click(function (e) { 
        e.preventDefault();

        if(switching) {
            return;
        };

        switching = true;

        $(".article").each(function(){
            $(this).fadeOut(500);
        });
        
        $(".switch").each(function(){
            $(this).removeClass("active-switch");
        });

        $(".articleTwo").delay(500).fadeIn(500);
        $(".switchTwo").addClass("active-switch");

        setTimeout(function() {
            switching = false;
        }, 1000);
    });

    /////////////Switch three/////////////

    $(".switchThree").click(function (e) { 
        e.preventDefault();

        if(switching) {
            return;
        };

        switching = true;

        $(".article").each(function(){
            $(this).fadeOut(500);
        });
        
        $(".switch").each(function(){
            $(this).removeClass("active-switch");
        });
    
        $(".articleThree").delay(500).fadeIn(500);
        $(".switchThree").addClass("active-switch");

        setTimeout(function() {
            switching = false;
        }, 1000);
    });
});