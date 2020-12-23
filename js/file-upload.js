const iconSize = 45;

const fileNotChosen = `<div class="my-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="${iconSize}" height="${iconSize}" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                            </svg>
                        </div>
                        <div class="file-name">
                            Inserire Immagine
                        </div>`;

const fileChosen = `<div class="my-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="${iconSize}" height="${iconSize}" fill="currentColor" class="bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>
                    </div>
                    <div class="file-name">
                    </div>`;

$(function(){
    span = $("span.upload-img");
    span.html(fileNotChosen);

    $("input[type='file'].file-upload").on("change", function () {
        if($(this).val() != ''){
            //file è stato scelto
            span.html(fileChosen);
            $("div.file-name").html($(this).val());

            $("label.upload-img-label").removeClass("btn-outline-dark");
            $("label.upload-img-label").addClass("btn-outline-secondary");
        } else {
            //file non scelto 
            span.html(fileNotChosen);
            $("label.upload-img-label").removeClass("btn-outline-secondary");
            $("label.upload-img-label").addClass("btn-outline-dark");

        }   
    });
});