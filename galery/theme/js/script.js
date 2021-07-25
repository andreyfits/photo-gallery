function showImages(idImg, idGalery) {

    $(".galery_view_bg, .galery_view_img").css({'display': 'block'});
    $('body').css({'overflow': 'hidden'});

    $.ajax({
        url: path + 'galery.php',
        data: 'id_image=' + idImg + '&id_galery=' + idGalery,
        type: 'POST',
        dataType: 'json',
        success: function (html) {
            $(".galery_view_img").empty();
            $(".galery_view_img").append(html);
        }

    });
}

function get_allcom(idGalery, idImg, obj, act, limit) {
    var offs = obj.attr('offs').split('/');

    if (parseInt(offs[1]) > parseInt(offs[0])) {
        if (act == 'image') {
            idGalery = 0;
        }
        if (act == 'gal') {
            idImg = 0;
        }

        $.ajax({

            url: path + 'galery.php',
            data: 'id_image=' + idImg + '&id_galery=' + idGalery + "&allcom=1&number=" + offs[1],
            type: 'POST',
            success: function (html) {
                obj.next().append(html);
                obj.text("Скрыть");
                obj.attr("offs", offs[1] + "/" + offs[1])
            }

        });
    } else {
        if (limit) {
            var com = obj.next().children().slice(0, limit);
            obj.next().empty().html(com);
            obj.text("Показать все " + offs[1] + " комментариев");
            obj.attr("offs", limit + "/" + offs[1]);
        }
    }
}


$(document).ready(function () {

    $(".galery_view_img").on('click', '.galery_close_img', function () {
        $(".galery_view_img").empty();
        $(".galery_view_bg, .galery_view_img").css({'display': 'none'});
        $("body").css({'overflow': 'auto'});
    });


    $(".galery_wrap").on('click', ".galery_reply", function () {
        var h = $(this).parents('.galery_com_single');

        var form = h.parent().parent().find('form');

        var name = h.children('.galery_com_name').text() + ", ";

        var id = h.attr('id');

        form.children('textarea').val(name).focus();

        form.children('input[name=parent_id]').val(id);
    });


    $(".galery_wrap").on('click', '#send_comment', function () {

        var r = $(this).parent('form');
        var mydata = r.serializeArray();

        $.ajax({
            url: path + 'galery.php',
            data: mydata,
            type: 'POST',
            success: function (html) {
                if (html) {
                    r.parent('div').prepend(html);
                    r.parent('div').find('.not_com').html('');
                }
            }
        });
    });

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