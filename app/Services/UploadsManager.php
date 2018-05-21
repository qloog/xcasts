<?php

namespace App\Services;

use App\Models\Image;
use Carbon\Carbon;
use Dflydev\ApacheMimeTypes\PhpRepository;
use Illuminate\Support\Facades\Storage;
use Auth;
use Symfony\Component\HttpFoundation\File\File;

class UploadsManager
{
    protected $disk;
    protected $mimeDetect;

    public function __construct(PhpRepository $mimeDetect)
    {
        $this->disk = Storage::disk(config('custom.uploads.storage'));
        $this->mimeDetect = $mimeDetect;
    }

    /**
     * Return files and directories within a folder
     *
     * @param string $folder
     * @return array of [
     *    'folder' => 'path to current folder',
     *    'folderName' => 'name of just current folder',
     *    'breadCrumbs' => breadcrumb array of [ $path => $foldername ]
     *    'folders' => array of [ $path => $foldername] of each subfolder
     *    'files' => array of file details on each file in folder
     * ]
     */
    public function folderInfo($folder)
    {
        $folder = $this->cleanFolder($folder);

        $breadcrumbs = $this->breadcrumbs($folder);
        $slice = array_slice($breadcrumbs, -1);
        $folderName = current($slice);
        $breadcrumbs = array_slice($breadcrumbs, 0, -1);

        $subfolders = [];
        foreach (array_unique($this->disk->directories($folder)) as $subfolder) {
            $subfolders["/$subfolder"] = basename($subfolder);
        }

        $files = [];
        foreach ($this->disk->files($folder) as $path) {
            $files[] = $this->fileDetails($path);
        }

        return compact(
            'folder',
            'folderName',
            'breadcrumbs',
            'subfolders',
            'files'
        );
    }

    /**
     * Sanitize the folder name
     * @param $folder
     * @return string
     */
    protected function cleanFolder($folder)
    {
        return '/' . trim(str_replace('..', '', $folder), '/');
    }

    /**
     * Return breadcrumbs to current folder
     * @param $folder
     * @return array
     */
    protected function breadcrumbs($folder)
    {
        $folder = trim($folder, '/');
        $crumbs = ['/' => 'root'];

        if (empty($folder)) {
            return $crumbs;
        }

        $folders = explode('/', $folder);
        $build = '';
        foreach ($folders as $folder) {
            $build .= '/'.$folder;
            $crumbs[$build] = $folder;
        }

        return $crumbs;
    }

    /**
     * Return an array of file details for a file
     * @param $path
     * @return array
     */
    protected function fileDetails($path)
    {
        $path = '/' . ltrim($path, '/');

        return [
            'name' => basename($path),
            'fullPath' => $path,
            'webPath' => $this->fileWebpath($path),
            'mimeType' => $this->fileMimeType($path),
            'size' => $this->fileSize($path),
            'modified' => $this->fileModified($path),
        ];
    }

    /**
     * Return the full web path to a file
     * @param $path
     * @return string
     */
    public function fileWebpath($path)
    {
        $path = rtrim(config('custom.uploads.webpath'), '/') . '/' .
            ltrim($path, '/');
        return url($path);
    }

    /**
     * Return the mime type
     * @param $path
     * @return null|string
     */
    public function fileMimeType($path)
    {
        return $this->mimeDetect->findType(
            pathinfo($path, PATHINFO_EXTENSION)
        );
    }

    /**
     * Return the file size
     * @param $path
     * @return
     */
    public function fileSize($path)
    {
        return $this->disk->size($path);
    }

    /**
     * Return the last modified time
     * @param $path
     * @return Carbon
     */
    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
            $this->disk->lastModified($path)
        );
    }

    /**
     * Create a new directory
     * @param $folder
     * @return string
     */
    public function createDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        if ($this->disk->exists($folder)) {
            return "Folder '$folder' aleady exists.";
        }

        return $this->disk->makeDirectory($folder);
    }

    /**
     * Delete a directory
     * @param $folder
     * @return string
     */
    public function deleteDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        $filesFolders = array_merge(
            $this->disk->directories($folder),
            $this->disk->files($folder)
        );
        if (! empty($filesFolders)) {
            return "Directory must be empty to delete it.";
        }

        return $this->disk->deleteDirectory($folder);
    }

    /**
     * Delete a file
     * @param $path
     * @return string
     */
    public function deleteFile($path)
    {
        $path = $this->cleanFolder($path);

        if (! $this->disk->exists($path)) {
            return "File does not exist.";
        }

        return $this->disk->delete($path);
    }

    /**
     * Save a file
     * @param $path
     * @param $content
     * @return string
     */
    public function saveFile($path, $content)
    {
        $path = $this->cleanFolder($path);

        if ($this->disk->exists($path)) {
            return "File already exists.";
        }

        return $this->disk->put($path, $content);
    }

    /**
     * 上传图片,返回图片的相对路径
     *
     * @param File $file
     * @param bool $isPublic
     * @return string
     *
     */
    public function uploadImage($file, $isPublic=false)
    {
        if (!is_object($file)) {
            return '';
        }

        $allowed_extensions = ["png", "jpg", 'jpeg', "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }
        $fileName        = $file->getClientOriginalName();
        $extension       = $file->getClientOriginalExtension() ?: 'png';
        $folderName      = rtrim(config('custom.uploads.images'), '/') . '/' . date("Y/m", time()) .'/'.date("d", time());
        $destinationPath = public_path() . '/' . $folderName;
        $safeNameWithoutExt = str_random(10);
        $safeName        = $safeNameWithoutExt . '.' . $extension;
        $file->move($destinationPath, $safeName);
        // If is not gif file, we will try to reduse the file size
        if ($file->getClientOriginalExtension() != 'gif') {
            // open an image file
//            $img = Image::make($destinationPath . '/' . $safeName);
//            // prevent possible upsizing
//            $img->resize($width, $height, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//            // finally we save the image as a new file
//            $img->save();
            //save to db
            Image::create(['image_name' => $safeNameWithoutExt, 'image_path' => $folderName .'/'. $safeName, 'user_id' => Auth::user()->id]);
        }

        $imagePath = $folderName .'/'. $safeName;
        (new QiNiuService($isPublic))->upload(trim($imagePath, '/'), public_path() . $imagePath);

        return [
            'origin_name' => $fileName,
            'extension' => $extension,
            'image_path' => $folderName .'/'. $safeName
        ];
    }

    /**
     * 上传图片,返回图片的相对路径
     *
     * @param File  $file
     * @param array $allowed_extensions
     *
     * @return string
     */
    public function uploadFile($file, $allowed_extensions = ["mp4"])
    {
        if (!is_object($file)) {
            return [
                'origin_name' => '',
                'extension' => '',
                'file_path' => ''
            ];
        }

        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }
        $fileName        = $file->getClientOriginalName();
        $extension       = $file->getClientOriginalExtension() ?: 'mp4';
        $folderName      = rtrim(config('custom.uploads.videos'), '/') . '/' . date("Y/m", time()) .'/'.date("d", time());
        $destinationPath = public_path() . '/' . $folderName;
        $safeNameWithoutExt = str_random(10);
        $safeName        = $safeNameWithoutExt . '.' . $extension;
        $file->move($destinationPath, $safeName);
        // If is not gif file, we will try to reduse the file size
        Image::create(['image_name' => $safeNameWithoutExt, 'image_path' => $folderName .'/'. $safeName, 'user_id' => Auth::user()->id]);

        $imagePath = $folderName .'/'. $safeName;

        (new QiNiuService())->upload(trim($imagePath, '/'), public_path() . $imagePath);

        return [
            'origin_name' => $fileName,
            'extension' => $extension,
            'file_path' => $folderName .'/'. $safeName
        ];
    }
}
