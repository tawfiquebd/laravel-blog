<?php
namespace App\Traits;

trait MyTrait
{
    public function deleteImage($path, $image) {
        if(file_exists(public_path().$path.$image)) {
            unlink(public_path().$path.$image);
        }
    }
}
