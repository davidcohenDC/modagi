const enable = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>`;

const disable = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>`;

$(function(){
    /* set up */
    $("button.select").each(function(){
        $(this).addClass("yes-select");

        //? change color
        $(this).addClass("btn-success");

        //? change text
        if(!$(this).hasClass("size")){
            $(this).children().html(enable);
        }
        
        //? close input
        $(this).next().prop("disabled", false);
    });

    const changeButtons = $("button.select");

    changeButtons.on("click", function(e){
        e.preventDefault();
        
        if($(this).hasClass("yes-select")){

            //* set up next
            $(this).removeClass("yes-select");
            $(this).addClass("no-select");

            //? change color
            $(this).removeClass("btn-success");
            $(this).addClass("btn-grigio");
 
            //? change text
            if(!$(this).hasClass("size")){
                $(this).children().html(disable);
            }

            //? open input
            $(this).next().prop("disabled", true);
        } else {
            //* set up next
            $(this).removeClass("no-select");
            $(this).addClass("yes-select");

            //? change color
            $(this).removeClass("btn-grigio");
            $(this).addClass("btn-success");

            //? change text
            if(!$(this).hasClass("size")){
                $(this).children().html(enable);
            }
            //? close input
            $(this).next().prop("disabled", false);
        }
    });
});