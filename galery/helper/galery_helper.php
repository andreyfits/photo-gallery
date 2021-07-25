<?php

require_once "galerybd_helper.php";

function tmpl($var = [], $tmp)
{
    extract($var);

    $path = G_PATH . "/theme/" . $tmp . ".tpl.php";

    if (file_exists($path)) {

        ob_start();
        require_once $path;
        return ob_get_clean();
    }
    exit();
}

function render_galery($id_galery)
{
    if ($id_galery) {
        $images = get_images($id_galery);

        $count_comm = get_count_comments(false, $id_galery);
        $comments = get_comments($id_galery);

        ////

        $simg = $images;
        $count = count($simg);

        $rows = [];
        $imgs = true;
        $i = 0;

        if ($count > 15) {
            $rows[0] = array_splice($simg, 0, 2);
            $rows[1] = array_splice($simg, 0, 8);
        } else {
            while ($imgs) {
                $rowLimit = G_ROW_IMG;

                $summ = $i + $rowLimit;

                if ($summ > $count) {
                    $rowLimit = $count - $i;
                }

                $r = array_splice($simg, 0, $rowLimit);

                if (!$r) {
                    break;
                }

                $rows[] = $r;

                $i += G_ROW_IMG;

                if ($i >= $count) {
                    $imgs = false;
                }
            }
        }


        foreach ($rows as $row) {
            $width = [];
            $height = [];

            foreach ($row as $img) {
                $i = imagecreatefromjpeg(G_PATH . '/' . G_IMG_MEDIUM . $img['path_images']);
                $width[] = imagesx($i);
                $height[] = imagesy($i);
                imagedestroy($i);
            }

            foreach ($width as $key => $val) {
                $width[$key] = floor($val * min($height) / $height[$key]);
            }

            $rh = floor(min($height) * G_ROW_WIDTH / array_sum($width));

            $width1 = [];

            foreach ($width as $key => $val) {
                $width1[] = floor($val * $rh / min($height));
            }

            $width_img[] = $width1;
            $row_height[] = $rh;
        }


        ///
        $comments_str = tmpl(
            [
                'comments' => $comments
            ],
            'galery_com_single'
        );
        $comments_tmp = tmpl(
            [
                'comments_str' => $comments_str,
                'id_galery' => $id_galery,
                'act' => 'gal',
                'count_comm' => $count_comm[0]['count']
            ],
            'galery_com'
        );

        return tmpl(
            [
                'comments' => $comments_tmp,
                'row_height' => $row_height,
                'width_img' => $width_img,
                'rows' => $rows,
                'id_galery' => $id_galery
            ],
            'galery'
        );
    }
}

function render_image($id_image, $id_galery)
{
    if ($id_image && $id_galery) {
        $image = get_image($id_image, $id_galery);

        $arr = [];

        foreach ($image as $key => $item) {
            if ($item['id_images'] == $id_image) {
                $item['path_images'] = G_SITE . G_IMG_LARGE . $item['path_images'];
                $arr['img'] = $item;
                $arr['pos'] = $key + 1;

                if ($key == count($image) - 1) {
                    $arr['next'] = $image[0]['id_images'];
                } else {
                    $arr['next'] = $image[$key + 1]['id_images'];
                }

                $arr['back'] = ($key == 0) ? $image[count($image) - 1]['id_images'] : $image[$key - 1]['id_images'];

                $arr['summ'] = count($image);
                $arr['gal'] = $id_galery;

            }
        }

        $count_comm = get_count_comments($id_image);
        $comments = get_comments(false, $id_image);

        $comments_str = tmpl(
            [
                'comments' => $comments
            ],
            'galery_com_single'
        );

        $arr['comments'] = tmpl(
            [
                'comments_str' => $comments_str,
                'id_galery' => $id_galery,
                'id_image' => $id_image,
                'act' => 'image',
                'count_comm' => $count_comm[0]['count']
            ],
            'galery_com'
        );

        return tmpl(
            [
                'arr' => $arr,
            ],
            'galery_image'
        );

    }
}

function send_comments($post)
{

    $arr = [];

    foreach ($post as $key => $item) {
        $var = strip_tags($item);

        if (($key == 'name_author') && empty($var)) {
            return false;
        }

        if (($key == 'text_comments') && empty($var)) {
            return false;
        }

        $arr[$key] = $var;

    }

    if (!empty($arr)) {
        $result = add_comment($arr);
        if (!$result) {
            return false;
        }

        return $result;
    }
}