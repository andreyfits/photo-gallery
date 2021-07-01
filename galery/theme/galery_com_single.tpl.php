<?php if ($comments) : ?>
    <?php foreach ($comments as $com) : ?>
        <div class="galery_com_single" id="<?php echo $com['id_comments']; ?>">
            <p class="galery_com_name"><?php echo $com['name_author']; ?></p>
            <p class="galery_com_text"><?php echo $com['text_comments']; ?></p>
            <p><span class="galery_com_date"> <?php echo date('d.m.Y', $com['time']); ?></span> | <span class="galery_reply"> Ответить </span></p>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p class="not_com">Комментов нет</p>
<?php endif; ?>