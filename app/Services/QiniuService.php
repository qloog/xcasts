<?php

namespace App\Services;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiNiuService
{

    private $auth = '';

    private $token = '';

    private $uploadMgr;

    public function __construct()
    {
        $this->auth = new Auth(env('QINIU_AccessKey'), env('QINIU_SecretKey'));
        $this->token = $this->auth->uploadToken(env('QINIU_Bucket'));
        $this->uploadMgr = new UploadManager();
    }

    public function upload($fileName, $filePath)
    {
        list($ret, $err) = $this->uploadMgr->putFile($this->token, $fileName, $filePath);
        echo "\n====> putFile result: \n";
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }
    }

    public function fileUrlWithToken($url)
    {
        return $this->auth->privateDownloadUrl($url);
    }
}