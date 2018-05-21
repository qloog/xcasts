<?php

namespace App\Http\Controllers\Frontend;

use App\Services\UploadsManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{

    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * common upload image with js
     *
     * @return Response
     */
    public function uploadImage()
    {
        $imageInfo = $this->manager->uploadImage(Input::file('file'), true);

        return response()->json(['filename' => thumb($imageInfo['image_path'], 1240, 1240, 2, false)]);
    }
}
