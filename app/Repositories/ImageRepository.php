<?php
namespace App\Repositories;

use Illuminate\Support\Facades\File;

class ImageRepository
{
    public function saveImage($image, $type, $size)
    {
        if (!is_null($image)) {
            $file = $image;
            $extension = $this->getB64Type($file);
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $fileName = time() . $randomString .'.' . $extension; 
            $destinationPath = public_path('img/'.$type.'/');
            $url = 'http://'.$_SERVER['HTTP_HOST'].'/img/'.$type.'/' .$fileName;
            $fullPath = $destinationPath.$fileName;
            
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }

            list($originalWidth, $originalHeight) = getimagesize($file);
            $imageTemp = imagecreatetruecolor($originalWidth, $originalHeight);
            $image = imagecreatefromstring(file_get_contents($file));

            if ($extension == 'png') {
                imagealphablending($imageTemp, false);
                imagesavealpha($imageTemp,true);
                $transparent = imagecolorallocatealpha($imageTemp, 255, 255, 255, 127);
                imagefilledrectangle($imageTemp, 0, 0, $originalWidth, $originalHeight, $transparent);  
            }

            imagecopyresampled($imageTemp, $image, 0, 0, 0, 0, $originalWidth, $originalHeight, $originalWidth, $originalHeight);
            $this->imageCreate($imageTemp, $fullPath, $extension);
            imagedestroy($imageTemp);
            imagedestroy($image);
            
            return $url;
        } else {
            return 'http://'.$_SERVER['HTTP_HOST'].'/img/sem-foto-perfil.jpg';
        }
    }

    public function getB64Type($str) {
        return substr($str, 11, strpos($str, ';') - 11);
    }

    public function imageCreate($img, $imgPath, $ext) 
    {
        if ($ext == 'gif') {
            imagegif($img, $imgPath);   
        } else if($ext == 'png') {
            imagepng($img, $imgPath);
        } else {
            imagejpeg($img, $imgPath);
        }
    }
}