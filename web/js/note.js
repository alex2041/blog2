$(document).ready(function(){
    var body = $("body");

    body.on("click", ".fHead", function(){
        if($(this).attr('f_id')){
            location.href = location.pathname + $(this).attr('f_id') ? ("?f_id=" + $(this).attr('f_id')) : '';
        }else{
            location.href = location.pathname;
        }
    });

    body.on("click", ".noteP", function(){
        var id = $(this).attr("note_id");

        $(".noteP").removeClass("selectNote");
        $(this).addClass('selectNote');

        $.ajax({
            url: '/note/',
            data: {
                n_id: id
            }
        }).done(function(data) {
            $("#nName").html($.trim(data.name));
            $("#nContent").html($.trim(data.content));
            window.history.pushState({}, "", location.pathname + "?n_id=" + id + "#" + id);
        });
    });
});