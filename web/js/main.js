$(document).ready(function(){
    $('.igo:last-child').click(function(){
        $(document).scrollTop($(document).outerHeight(true));
    });
    $('.igo:first-child').click(function(){
        $(document).scrollTop(0);
    });

    var body = $("body"); var img, imgs, img_id, i;

    function slideGallery() {
        img = i.clone();

        if(imgs.length == 1){
            $('.modal-footer').hide();
        }

        if(imgs.eq(img[0])){
            img_id = $.inArray(i[0],imgs);
            img.removeAttr("width").removeAttr("height").removeAttr("style");
            img.css({
                maxWidth : "100%",
                maxHeight : "100%"
            });
            img.attr("alt") ? $('.mh').html(img.attr("alt")) : $('.mh').html(img.attr("src").match(/([\w,\s-]+)\.[A-Za-z]{3}/)[1]);
            $('.modal-body').html(img);
        }
    }

    body.on("click", ".gallery-th-large", function(){
        $(this).removeClass('gallery-th-large').addClass('gallery-big');
        $(this).find('span').removeClass('glyphicon-th-large').addClass('glyphicon-stop');
        $(this).parents('.panel').find('.col-md-2').removeClass('col-md-2').removeClass('col-xs-4').addClass('col-md-6').find('.img').css('height', '384px');
    });

    body.on("click", ".gallery-big", function(){
        $(this).removeClass('gallery-big').addClass('gallery-th');
        $(this).find('span').removeClass('glyphicon-stop').addClass('glyphicon-th');
        $(this).parents('.panel').find('.col-md-6').removeClass('col-md-6').addClass('col-md-12').find('.img').css('height', 'auto');
    });

    body.on("click", ".gallery-th", function(){
        $(this).removeClass('gallery-th').addClass('gallery-th-large');
        $(this).find('span').removeClass('glyphicon-th').addClass('glyphicon-th-large');
        $(this).parents('.panel').find('.col-md-12').removeClass('col-md-12').addClass('col-md-2').addClass('col-xs-4').find('.img').css('height', '108px');
    });

    body.on("click", ".psview .img", function(){
        i = $(this);
        imgs = $('.psview .img');
        img_id = $.inArray($(this)[0],imgs);

        slideGallery();

        $('#gallery').modal();
    });

    body.on("click", ".prev", function(){
        (img_id == 0) ? i = imgs.eq(imgs.length - 1) : i = imgs.eq(img_id - 1);
        slideGallery();
    });

    body.on("click", ".next", function(){
        ((img_id + 1) == imgs.length) ? i = imgs.eq(0) : i = imgs.eq(img_id + 1);
        slideGallery();
    });

    body.on("keydown", function(e){
        if($("#gallery").hasClass("in")){
            if(e.keyCode === 37) {
                (img_id == 0) ? i = imgs.eq(imgs.length - 1) : i = imgs.eq(img_id - 1);
                slideGallery();
            }
            else if(e.keyCode === 39) {
                ((img_id + 1) == imgs.length) ? i = imgs.eq(0) : i = imgs.eq(img_id + 1);
                slideGallery();
            }
        }
    });
});