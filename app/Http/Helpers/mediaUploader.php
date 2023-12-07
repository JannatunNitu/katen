<?php

namespace App\Http\Helpers;

trait mediaUploader{
    function uploadSingleMedia ($title,$media, $path='posts', $type = 'public'){
        $fileName = $title . "." . $media->extension();
        $upload = $media->storeAs($path, $fileName, $type);
        return $upload;
    }
}