<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
  public function delete ($id)
  {
    $material = Material::with('images')->where('id', $id)->firstOrFail();
    if ($material) {
      foreach ($material->images() as $image) {
        Storage::disk(env('FILE_DRIVER'))->delete($image->fileName);
      }
      Material::destroy($id);
    }

    return response()->json(['message' => true]);
  }
}
