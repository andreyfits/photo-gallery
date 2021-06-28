<?php if ($comments_str) : ?>
    <?php echo $comments_str; ?>
<?php else : ?>
    <p class="not_com">Комментов нет</p>
<?php endif; ?>
<p class="galery_com_new">Новый комментарий</p>
<form>
    Имя:<br/>
    <input size="50" type="text" name="name_author">

    <input type="hidden" name="id_image" value="">
    <input type="hidden" name="id_galery" value="">
    <input type="hidden" name="parent_id" value="">
    <input type="hidden" name="act" value="">
    <br/>Текст:<br/>
    <textarea cols="50" rows="5" name="text_comments"></textarea><br/><br/>

    <input type="button" id="send_comment" value="Отправить">
</form>