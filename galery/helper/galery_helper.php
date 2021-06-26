<?php

require_once "galerybd_helper.php";

function render_galery($id_galery)
{
    if ($id_galery) {
        $images = get_images($id_galery);
        $comments = get_comments($id_galery);

        ///

        $simg = $images;
        $count = count($images);

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
            foreach ($width as $val) {
                $width1[] = floor($val * $rh / min($height));
            }

            $width_img[] = $width1;

            $row_height[] = $rh;

        }

        ///
        ob_start();
        require_once G_PATH . '/theme/' . "galery.tpl.php";
        return ob_get_clean();
    }
}