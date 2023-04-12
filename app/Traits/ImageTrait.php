<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait ImageTrait
{
    public function uploadImage($image , $modelName)
    {
        $imageName = Str::random() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($modelName.'/image', $image, $imageName); 
        return $imageName;
    }

    public function destroyCategoryImage($image , $modelName)
    {
        $exist = Storage::disk('public')->exists($modelName."/image/{$image}");
        if ($exist) {
            Storage::disk('public')->delete($modelName."/image/{$image}");
        }
    }


    public function destroyImage($images , $modelName)
    {
        foreach ($images->image as $img){
            if ($img) {
                $exist = Storage::disk('public')->exists($modelName."/image/{$img}");
                if ($exist) {
                    Storage::disk('public')->delete($modelName."/image/{$img}");
                }
            }
        }
    }

    public function Qr_Image($image_name)
    {
        //--QR Image..---
        $name = $image_name;
        $qr_img_type = 'png';
        $qr_image = Str::slug($name) . 'QR' .Str::random(). '.' . $qr_img_type;
        $body = 'https://www.youtube.com/';
        $qr = QrCode::format($qr_img_type);
        $qr->size('300');
        //--Store QR-Image.. 
        $qr->generate($body,'storage/product/image/'. $qr_image);
       return $qr_image;
    }
}
