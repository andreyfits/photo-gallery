<?php if ($comments_str) : ?>

    <?php if (($count_comm - G_LIMIT_COM) > 0) : ?>
        <p class="next_comm" offs="<?php echo G_LIMIT_COM ?>/<?php echo $count_comm ?>" onclick="get_allcom(<?php echo $id_galery ?: 0; ?>,<?php echo @$id_image ?: 0; ?>,$(this),'<?php echo $act; ?>',<?php echo G_LIMIT_COM ?>)">Показать все <?php echo $count_comm ?> комментариев</p>
    <?php endif; ?>

    <div class="list-comments">
        <?php echo $comments_str; ?>
    </div>
<?php endif; ?>
<p class="galery_com_new">Новый комментарий</p>
<form>
    Имя:<br/>
    <input size="50" type="text" name="name_author">

    <input type="hidden" name="id_image" value="<?php echo @$id_image; ?>">
    <input type="hidden" name="id_galery" value="<?php echo $id_galery; ?>">
    <input type="hidden" name="parent_id" value="">
    <input type="hidden" name="act" value="<?php echo $act; ?>">
    <br/>Текст:<br/>
    <textarea cols="50" rows="5" name="text_comments"></textarea><br/><br/>

    <input type="button" id="send_comment" value="Отправить">
</form>