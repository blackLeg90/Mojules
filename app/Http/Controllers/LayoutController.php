<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layout;
use Illuminate\Support\Facades\Storage;

class LayoutController extends Controller
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
    $layout = Layout::find($id);
    if ($layout) {
      Storage::disk(env('FILE_DRIVER'))->delete($layout->fileName);
      Layout::destroy($id);
    }
    return response()->json(['message' => true]);
  }
}
