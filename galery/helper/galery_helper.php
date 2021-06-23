<?php

require_once "galerybd_helper.php";

function render_galery($id_galery)
{
    if ($id_galery) {
        $images = get_images($id_galery);
        $comments = get_comments($id_galery);


        ob_start();
        require_once G_PATH . '/theme/' . "galery.tpl.php";
        return ob_get_clean();
    }
}