$(function(){
    const eye = $("button#eye");
    const password = $("input#password");
    
    eye.on("click", function(e) {
        e.preventDefault();

        if($(this).hasClass("show-password")){
            /* set next action */
            $(this).removeClass("show-password");
            $(this).addClass("hide-password");
            
            /* show password */
            password.prop("type", "text");
            /* change icon */
            
        } else {
            /* set next action */
            $(this).removeClass("hide-password");
            $(this).addClass("show-password");
        
            /* show password */
            password.prop("type", "password");
            /* change icon */

        }
    });
});