<script>var path = '<?php echo G_SITE;?>'</script>
<div class="galery_wrap">
    <?php $i = 0; ?>
    <?php foreach ($rows as $row) : ?>
        <div class="line">
            <?php foreach ($row as $k => $item) : ?>
                <img onclick="showImages(<?php echo $item['id_images']; ?>,<?php echo $id_galery; ?>)" style="height:<?php echo $row_height[$i]; ?>px; width:<?php echo $width_img[$i][$k]; ?>px" src="<?php echo G_SITE . G_IMG_MEDIUM . $item['path_images'] ?>">
            <?php endforeach; ?>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>
    <div class="galery_clear"></div>

    <h2>Комментарии</h2>
    <div class="galery_comments">
        <?php echo $comments; ?>
    </div>

    <div class="galery_view_bg"></div>

    <div class="galery_view_img"></div>

</div>
