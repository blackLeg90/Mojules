<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
  public function delete ($id)
  {
    $room = Room::with('materials.images')->where('id', $id)->get()->pop();
    if ($room) {
      Storage::disk(env('FILE_DRIVER'))->delete($room->roomImage);
      foreach($room->materials as $material) {
        foreach($material->images as $image) {
          if ($image->fileName) Storage::disk(env('FILE_DRIVER'))->delete($image->fileName);
        }
      }
      Room::destroy($id);
    }
    return response()->json(['message' => true]);
  }

  public function saveImage (Request $request, $fileName, $roomId = NULL)
  {
    if ($request->file('file')->isValid()) {
      Storage::disk(env('FILE_DRIVER'))->put($fileName, file_get_contents($request->file('file')));
      if ($roomId !== NULL) {
        \DB::table('rooms')
          ->where('id', $roomId)
          ->update(['roomImage' => $fileName]);
      }
      return response()->json(['message' => true]);
    }
    return response()->json(['message' => 'Fail upload.'], 400);
  }

  public function removeImage (Request $request, $fileName)
  {
    try {
      Storage::disk(env('FILE_DRIVER'))->delete($fileName);
      \DB::table('rooms')
        ->where('roomImage', $fileName)
        ->update(['roomImage' => NULL]);
      return response()->json(['message' => true]);
    } catch (Exception $e) {
      return response()->json(['message' => 'Fail delete.'], 400);
    }
  }
}
