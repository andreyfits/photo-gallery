<?php

function connect_db()
{
    $db = mysqli_connect(GDB_HOST, GDB_USER, GDB_PASSWORD, GDB_NAME);

    if (mysqli_connect_error($db)) {
        exit(mysqli_connect_error($db));
    }

    mysqli_query($db, "SET NAMES UTF8");

    return $db;
}

function get_result($result, $db)
{
    if (!$result) {
        exit(mysqli_error($db));
    }

    if (mysqli_num_rows($result) < 1) {
        return false;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_images($id)
{
    global $db;

    if (!$db instanceof mysqli) {
        $db = connect_db();
    }

    $sql = "SELECT id_images,path_images FROM images WHERE id_galery = '$id'";

    $result = mysqli_query($db, $sql);

    return get_result($result, $db);
}

function get_comments($id_galery = false, $id_images = false, $limit = false)
{
    global $db;

    $sql = "SELECT id_comments,text_comments, name_author, email_author,time,parent_id FROM comments ";

    if ($id_galery) {
        $sql .= " WHERE id_galery ='$id_galery'";
    } elseif ($id_images) {
        $sql .= " WHERE id_images ='$id_images'";
    }

    if ($limit) {
        $sql .= " LIMIT " . $limit;
    }

    $sql .= " ORDER BY id_comments DESC";

    $result = mysqli_query($db, $sql);

    return get_result($result, $db);

}

function get_image($id_image, $id_galery)
{
    global $db;

    if (!$db instanceof mysqli) {
        $db = connect_db();
    }

    $sql = "SELECT id_images,path_images,text_images FROM images WHERE id_galery='$id_galery'";

    $result = mysqli_query($db, $sql);

    return get_result($result, $db);
}

function add_comment($post)
{
    global $db;

    if (!$db instanceof mysqli) {
        $db = connect_db();
    }

    if (!is_array($post)) {
        return false;
    }

    foreach ($post as $key => $item) {
        $post[$key] = mysqli_real_escape_string($db, $item);
    }

    $parent_id = 0;
    if ($post['parent_id'] > 0) {
        $parent_id = (int)$post['parent_id'];
    }

    if ($post['act'] == 'image') {
        $sql = "INSERT INTO comments (id_images,text_comments,email_author,name_author,parent_id,time)
                VALUES ('" . $post['id_image'] . "','" . $post['text_comments'] . "', '" . $post['email_author'] . "','" . $post['name_author'] . "','" . $parent_id . "','" . time() . "')";
    } else if ($post['act'] == 'gal') {
        $sql = "INSERT INTO comments (id_galery,text_comments,email_author,name_author,parent_id,time)
                VALUES ('" . $post['id_galery'] . "','" . $post['text_comments'] . "', '" . $post['email_author'] . "', '" . $post['name_author'] . "','" . $parent_id . "','" . time() . "')";
    }

    $result = mysqli_query($db, $sql);

    if (!$result || mysqli_affected_rows($db) <= 0) {
        return false;
    }

    $id_last_com = mysqli_insert_id($db);

    $sql2 = "SELECT text_comments,name_author, parent_id, time FROM comments WHERE id_comments='$id_last_com'";

    $result2 = mysqli_query($db, $sql2);

    return get_result($result2, $db);
}