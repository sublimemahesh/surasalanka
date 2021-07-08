<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
session_start();
// dd($_POST);
if (isset($_POST['create'])) {

    if ($_SESSION['CAPTCHACODE'] == $_POST['captcha']) {

        $COMMENT = new Comments(NULL);

        $COMMENT->name = $_POST['name'];
        $COMMENT->title = $_POST['title'];
        $COMMENT->comment = $_POST['comment'];

        $dir_dest = '../../upload/comments/';

        $handle = new Upload($_FILES['image']);

        $imgName = null;
        $img = Helper::randamId();

        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 300;
            $handle->image_y = 300;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }

        $COMMENT->image_name = $imgName;
        $COMMENT->is_active = 0;
        $COMMENT->queue = 0;

        $res = $COMMENT->create();
        if ($res) {
            $result = 'success';
        } else {
            $result = 'error';
        }

        echo json_encode($result);
        exit();
    } else {
        $result = 'wrong_code';
        echo json_encode($result);
        exit();
    }
}
