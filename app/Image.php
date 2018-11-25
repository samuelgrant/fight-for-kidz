<?php

namespace App;

class Image //extends Model
{    

    /**
     *  Stores a given png or jpg image as a png image, 
     *  in the given path.
     * 
     *  $path should be like '/private/images/applicants/'
     *  $name should be like 'test.png'
     * 
     *  Return true if successful
     */
    public static function storeAsPng($image, $path, $name){
        
        $dir = storage_path('app\\' . $path);

        if(!file_exists($dir)){
            mkdir($dir);
        }

        switch(exif_imagetype($image)){

            case IMAGETYPE_PNG:
                break; // already a png;
            case IMAGETYPE_JPEG:
                $jpgImage = imagecreatefromjpeg($image);
                break;
            default:
                throw new InvalidArgumentException('Invalid image type (must be PNG or JPG)');
                // validation should prevent reaching this point.
        }

        if(isset($jpgImage)){
            // Create a png from the jpg image and output to file
            imagepng($jpgImage, storage_path('\app\\' . $path . $name));
        } else {
            // Save png to file
            $image->storeAs($path, $name);
        }

        return true;

    }

}
