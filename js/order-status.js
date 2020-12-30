const stepNotTaken = "text-secondary"

function findFor(className) {
    return className.includes("for-");
}

function findStep(className) {
    return className.includes("step-");
}

$(function(){
    $("input[type='hidden']").each(
        function(){
            forBar = $(this).attr("class").split(/\s+/).find(findFor);
            forBar = forBar.split("-")[1];
            
            status = $(this).val().split("-")[0]; 
            color = $(this).val().split("-")[1]; 

            $("div.s-"+forBar).children().each(function () {
                step = $(this).attr("class").split(/\s+/).find(findStep);
                step = step.split("-")[1];
                
                if (step < status + 1){
                    $(this).addClass("text-" + color);
                }else{
                    $(this).addClass(stepNotTaken);
                }
            });
        }
    );
});