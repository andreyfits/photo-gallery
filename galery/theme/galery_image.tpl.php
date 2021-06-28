<div class="galery_back_img" onclick="showImages(<?php echo $arr['back']; ?>,<?php echo $arr['gal']; ?>)"></div>

<div class="galery_img_wrap">

    <div class="galery_img">
        <p>Изображение <?php echo $arr['pos']; ?> из <?php echo $arr['summ']; ?> </p>
        <img onclick="showImages(<?php echo $arr['next']; ?>,<?php echo $arr['gal']; ?>)" src="<?php echo $arr['img']['path_images']; ?>">
        <p class="galery_image_text"><?php echo $arr['img']['text_images']; ?></p>
    </div>

    <h2>Комментарии</h2>

    <div class="galery_img_comments_wrap">
        <div class="galery_img_comments"><?php echo $arr['comments']; ?></div>
    </div>

</div>

<div class="galery_close_img"></div>