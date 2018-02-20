<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  public function saveImage (Request $request)
  {
    foreach ($request->file('file') as $file) {
      if ($file->isValid()) {
        Storage::disk(env('FILE_DRIVER'))->put($file->getClientOriginalName(), file_get_contents($file));
      } else {
        return response()->json(['message' => 'Fail upload.'], 400);
      }
    }
    return response()->json(['message' => true]);
  }

  public function removeImage (Request $request, $id)
  {
    $image = Image::find($id);
    if ($image) {
      Storage::disk(env('FILE_DRIVER'))->delete($image->fileName);
      Image::destroy($id);
    }
    return response()->json(['message' => true]);
  }
}
