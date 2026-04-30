<?php

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaDownloadController extends Controller
{
    public function index(int $id)
    {
        $media = Media::find($id);

        return response()->download($media->getPath(), $media->file_name);
    }
}
