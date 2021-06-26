function showImages(idImg, idGalery) {

    $(".galery_view_bg, .galery_view_img").css({'display': 'block'});


    $.ajax({

        url: path + 'galery.php',
        data: 'id_image=' + idImg + '&id_galery=' + idGalery,
        type: 'POST',
        dataType: 'json',
        success: function (html) {
            $(".galery_view_img").append('<div style="width:900px;margin:20px auto 0px auto"><img src="' + html['path_images'] + '"></div>');
        }

    });
}


$(document).ready(function () {

    var w_b = $(window).width();
    var h_b = $(window).height();

    $(".galery_view_bg, .galery_view_img").css({'width': w_b, 'height': h_b});

    var width_wrap = $(".galery_wrap").width();

    $(".line").each(function () {

        var v = $(this);

        var count = 0;

        v.children('img').each(function () {
            count += $(this).width();
        });

        var count_i = v.children('img').length - 1;

        var mr = Math.floor((width_wrap - count) / count_i);

        v.children('img').css({'marginRight': mr + 'px'});
        v.children('img:last').css({'marginRight': '0px', 'marginLeft': width_wrap - (count + mr * count_i) + 'px'});
    });
});