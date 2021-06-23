<div class="galery_wrap">

    <?php foreach ($images as $key => $item) : ?>

        <?php if ($key < 2) : ?>
            <img src="<?php echo G_SITE . G_IMG_MEDIUM . $item['path_images']; ?> ">
        <?php else: ?>
            <img src="<?php echo G_SITE . G_IMG_SMALL . $item['path_images']; ?> ">
        <?php endif; ?>

    <?php endforeach; ?>

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