<?php

class FileController {
    public static function uploadImage($image)
    {
        $fileName       = $image['name'];
        $fileType       = $image['type'];
        $fileSize       = $image['size'];
        $error          = $image['error'];
        $fileTmpName    = $image['tmp_name'];

        if($error == 4){
            return false;
            exit;
        }

        $fileTypeValidation = ['jpg', 'jpeg', 'png'];
        $imageFileType      = explode('.', $fileName);
        $imageFileType      = strtolower(end($imageFileType));

        if(!in_array($imageFileType, $fileTypeValidation)){
            return false;
            exit;
        }

        if($fileSize > 52428800){
            return false;
            exit;
        }

        $fileNewName = 'IMG' . uniqid() . '.'. $imageFileType;
        move_uploaded_file($fileTmpName, '../public/imgs/upload/'. $fileNewName);
        return $fileNewName;
    }

    public static function uploadCropImage($image)
    {
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        
        $imageName = 'IMG' . uniqid() . '.png';
        file_put_contents('../public/imgs/upload/'.$imageName, $image);

        return $imageName;
    }

    public static function deleteImage($image)
    {
        $imagePath = '../public/imgs/upload/' . $image;

        unlink($imagePath);

        if(!unlink($imagePath)){
            return false;
            exit;
        }else{
            return true;
            exit;
        }
    }

}