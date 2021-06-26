<div class="galery_wrap">
    <?php $i = 0; ?>
    <?php foreach ($rows as $row) : ?>
        <div class="line">
            <?php foreach ($row as $item) : ?>
                <img style="height: <?php echo $row_height[$i]; ?>px" src="<?php echo G_SITE . G_IMG_MEDIUM . $item['path_images']; ?>">
            <?php endforeach; ?>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>

    <div class="galery_clear"></div>

    <?php if ($comments): ?>


        <h2>Комментарии</h2>
        <?php foreach ($comments as $com) : ?>
            <div class="galery_com_single">
                <p><?php echo $com['name_author']; ?></p>
                <p><?php echo $com['text_comments']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <form>
            <input type="text">
            <textarea></textarea>
        </form>
    <?php endif; ?>

</div>