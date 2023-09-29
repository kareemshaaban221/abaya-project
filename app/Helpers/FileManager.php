<?php

namespace App\Helpers;

use Exception;

trait FileManager
{

    public function storeFile($file)
    {
        $new_filename = time() . '_' . $file['name'];
        $target = __DIR__ . '/../../resources/assets/uploads/' . $new_filename;
        if (!move_uploaded_file($file['tmp_name'], $target))
            throw new Exception('Could not move uploaded file');
        return $new_filename;
    }

    public function deleteFile($filename) {
        $target = __DIR__ . '/../../resources/assets/uploads/' . $filename;
        if (file_exists($target)) {
            unlink($target);
            return true;
        } else 
            return false;
    }

}