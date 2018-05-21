<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Processing\ImageUrlBuilder;

class QiNiuService
{

    private $auth = '';

    private $token = '';

    private $bucket = '';

    private $uploadMgr;

    /**
     * QiNiuService constructor.
     * @param bool $isPublicBucket
     */
    public function __construct($isPublicBucket=false)
    {
        $this->auth = new Auth(env('QINIU_AccessKey'), env('QINIU_SecretKey'));
        if ($isPublicBucket) {
            $this->bucket = env('QINIU_Public_Bucket');
        } else {
            $this->bucket = env('QINIU_Bucket');
        }

        $this->token = $this->auth->uploadToken($this->bucket);
        $this->uploadMgr = new UploadManager();
        $this->bucketMgr = new BucketManager($this->auth);
    }

    public function upload($fileName, $filePath)
    {
        list($ret, $err) = $this->uploadMgr->putFile($this->token, $fileName, $filePath);

        if ($err !== null) {
            Log::error('upload to qiniu error', (array)$err);
        } else {
            return $ret;
        }
    }

    public function fileUrlWithToken($url)
    {
        return $this->auth->privateDownloadUrl($url);
    }

    public function getThumbnail($url, $mode=1, $width=400, $height=300)
    {
        $imageUrlBuilder = new ImageUrlBuilder();

        return $imageUrlBuilder->thumbnail($url, $mode, $width, $height);
    }

    public function list($limit = 10)
    {
        $prefix = '';
        $marker = '';
        list($files, $marker, $err) = $this->bucketMgr->listFiles($this->bucket, $prefix, $marker, $limit);

        if ($err !== null) {
            echo "\n====> list file err: \n";
            var_dump($err);
        } else {
            return $files;
        }
    }
}