<?php

namespace App\Services;

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class QiNiuService
{

    private $auth = '';

    private $token = '';

    private $bucket = '';

    private $uploadMgr;

    public function __construct()
    {
        $this->auth = new Auth(env('QINIU_AccessKey'), env('QINIU_SecretKey'));
        $this->bucket = env('QINIU_Bucket');
        $this->token = $this->auth->uploadToken($this->bucket);
        $this->uploadMgr = new UploadManager();
        $this->bucketMgr = new BucketManager($this->auth);
    }

    public function upload($fileName, $filePath)
    {
        list($ret, $err) = $this->uploadMgr->putFile($this->token, $fileName, $filePath);

        if ($err !== null) {
            var_dump($err);
        } else {
            return $ret;
        }
    }

    public function fileUrlWithToken($url)
    {
        return $this->auth->privateDownloadUrl($url);
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