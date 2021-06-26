$(document).ready(function () {
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