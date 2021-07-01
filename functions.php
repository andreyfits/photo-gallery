<?php

function get_statti($cat = false)
{
    global $db;
    $sql = "SELECT id,title,date,img_src,discription,id_galery FROM statti";

    if ($cat) {
        $sql .= " WHERE cat = '$cat'";
    }

    $result = mysqli_query($db, $sql);

    if (!$result) {
        exit(mysqli_error($db));
    }
    if (mysqli_num_rows($result) === 0) {
        exit('Статей нет');
    }

    $row = [];

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    return $row;
}

function get_text($id)
{

    global $db;

    $sql = "SELECT id,title,date,img_src,text FROM statti WHERE id='$id'";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        exit(mysqli_error($db));
    }
    if (mysqli_num_rows($result) == 0) {
        exit('Статей нет');
    }

    $row = [];

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    return $row;
}

function get_cat()
{

    global $db;

    $result = mysqli_query($db, "SELECT id_category,name_category FROM category");

    if (!$result) {
        exit(mysqli_error($db));
    }

    if (mysqli_num_rows($result) === 0) {
        exit('Статей нет');
    }

    $row = [];

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    return $row;
}

function render($tmp, $vars)
{
    if (file_exists('theme/' . $tmp . ".tpl.php")) {
        ob_start();
        extract($vars);
        require_once 'theme/' . $tmp . ".tpl.php";
        return ob_get_clean();
    }
}
