<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaDownloadController extends Controller
{
    public function index(Request $request, int $id)
    {
        $media = Media::find($id);

        return $media->toResponse($request);
    }
}
