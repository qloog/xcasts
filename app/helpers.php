<?php
/*
 * Global helpers file with misc functions
 */
use App\Services\QiNiuService;

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name() {
        return config('app.name');
    }
}

if ( ! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if ( ! function_exists('human_filesize')) {
    /**
     * Return sizes readable by humans
     * @param int $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
        @$size[$factor];
    }
}

if ( ! function_exists('is_image')) {
    /**
     * Is the mime type an image
     * @param string $mimeType
     * @return bool
     */
    function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}

if ( ! function_exists('get_image_url')) {
    /**
     * get image path
     * @param string $imageName
     * @param bool   $fullUrl
     * @return string
     */
    function get_image_url($imageName, $fullUrl = false)
    {
        $image =  \Illuminate\Support\Facades\DB::table('images')->where('image_path', '=', $imageName)->first();
        $imagePath = $image ? $image->image_path : null;
        if ($fullUrl) {
            return $image ? get_static_domain() . $imagePath : get_static_domain() . config('custom.default_image');
        }
        return $image ? $imagePath : config('custom.default_image');
    }
}

if ( ! function_exists('get_static_domain')) {
    /**
     * get static domain
     * @return string
     */
    function get_static_domain()
    {
        return 'http://www.local.com/';
    }
}

if ( ! function_exists('get_relation_title')) {
    /**
     * get static domain
     * @param $type
     * @param $relation_id
     * @return string
     */
    function get_relation_title($type, $relation_id)
    {
        switch($type){
            case 'video':
                $obj = DB::table('videos')->select('name')->where('id', '=', $relation_id)->first();
                $title = $obj->name;
                break;
            case 'blog':
                $obj = DB::table('posts')->select('title')->where('id', '=', $relation_id)->first();
                $title = $obj->title;
                break;
            default:
                $title = '没有对应的分类';
                break;
        }
        return $title;
    }
}

/**
 * get cdn url for image or mp4
 *
 * @param $path
 * @return string
 */
function cdn($path)
{
    if (empty($path)) {
        return $path;
    }

    $qiNiuSrv = new QiNiuService();
    $url = env('QINIU_CDN_URL') . $path;

    return $qiNiuSrv->fileUrlWithToken($url);
}

/**
 * 获取缩略图的url, 带有效期和token验证
 *
 * @param     $path
 * @param int $width
 * @param int $height
 * @param int $mode
 * @return string
 */
function thumb($path, $width=400, $height=300, $mode=1)
{
    $qiNiuSrv = new QiNiuService();
    $url = env('QINIU_CDN_URL') . $path;

    $thumbnailUrl = $qiNiuSrv->getThumbnail($url, $mode, $width, $height);

    return $qiNiuSrv->fileUrlWithToken($thumbnailUrl);
}

/**
 * 格式化秒为时分
 *
 * @param $second
 * @return string
 */
function formatToMinute($second)
{
    $hour = floor($second / 3600);
    $minute = str_pad(floor(($second - 3600 * $hour) / 60), 2, '0', STR_PAD_LEFT);
    $second = str_pad(floor((($second - 3600 * $hour) - 60 * $minute) % 60), 2, '0', STR_PAD_LEFT);

    if ($hour && $minute) {
        return str_pad($hour, 2, '0', STR_PAD_LEFT) . ':' . $minute . ':' . $second;
    } elseif ($minute) {
        return $minute . ':' . $second;
    } else {
        return '00:' . $second;
    }
}

/**
 * 格式化秒为小时
 *
 * @param $second
 * @return string
 */
function formatToHour($second)
{
    return floor($second / 3600);
}

/**
 * @param \App\Models\User $user
 * @return mixed|string
 */
function get_avatar_url(\App\Models\User $user)
{
    if (!$user->avatar) {
        return '/avatars/default.png';
    }
    if (\Illuminate\Support\Str::startsWith($user->avatar, 'http')) {
        return $user->avatar ;
    }

    return cdn($user->avatar);
}

