<?php
require_once "g_config.php";
require_once G_HELPER . "galery_helper.php";

if (@$_POST['id_image'] && $_POST['id_galery']) {
    $id_image = (int)$_POST['id_image'];
    $id_galery = (int)$_POST['id_galery'];

    if ($id_image && $id_galery) {
        try {
            echo json_encode(render_image($id_image, $id_galery), JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
        }
    }
    exit();
}