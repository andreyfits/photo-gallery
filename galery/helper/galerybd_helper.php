<?php

function connect_db()
{

}

function get_result($result, $db)
{
    if (!$result) {
        exit(mysqli_error($db));
    }

    if (mysqli_num_rows($result) < 1) {
        return FALSE;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_images($id)
{
    global $db;

    if (!$db instanceof mysqli) {
        $db = connect_db();
    }

    $sql = "SELECT 
				id_images,path_images 
			FROM images
			WHERE id_galery = '$id'
				";
    $result = mysqli_query($db, $sql);

    return get_result($result, $db);
}

function get_comments($id_galery = FALSE, $id_images = FALSE, $limit = FALSE)
{
    global $db;

    $sql = "SELECT text_comments, name_author, email_author
			FROM comments ";
    if ($id_galery) {
        $sql .= " WHERE id_galery ='$id_galery'";
    } elseif ($id_images) {
        $sql .= " WHERE id_images ='$id_images'";
    }

    if ($limit) {
        $sql .= " LIMIT " . $limit;
    }

    $result = mysqli_query($db, $sql);

    return get_result($result, $db);

}