<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Room;
use App\Models\Material;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHome;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
  public function index ()
  {
      $homes = \DB::table('homes')->paginate(15);
      return view('homes', ['homes' => $homes]);
  }

  public function view ($id)
  {
    $home = Home::with('rooms.materials.images')->where('id', $id)->firstOrFail();
//    \Debugbar::info($home);

    return view('home-view', [
      'home' => $home->toJson()
    ]);
  }

  public function create (Request $request)
  {
    return view('home-form', [
      'types' => Home::$TYPES,
      'layouts' => Home::$LAYOUTS,
      'home' => NULL
    ]);
  }

  public function update (Request $request, $id)
  {
    $home = Home::with('rooms.materials.images')->where('id', $id)->firstOrFail();
    return view('home-form', [
      'types' => Home::$TYPES,
      'layouts' => Home::$LAYOUTS,
      'home' => $home
    ]);
  }

  public function store (Request $request, $id = NULL)
  {
    $input = $request->all();
    // \Debugbar::info($input);

    // validation: home
    $validationRules = [
      'homeName' => 'required',
      'availableTypes' => 'required',
      'layoutAvailable' => 'required'
    ];

    // validation: rooms
    if (array_key_exists('rooms', $input)) {
      foreach($input['rooms'] as $key => $roomFormAttr) {
        $validationRules['rooms.'.$key.'.roomName'] = 'required';

        // validation: materials
        if (array_key_exists('materials', $roomFormAttr)) {
          foreach($roomFormAttr['materials'] as $materialKey => $roomFormAttr) {
            $validationRules['rooms.'.$key.'.materials.'.$materialKey.'.materialName'] = 'required';
          }
        }
      }
    }
    $validationResults = $request->validate($validationRules);
    // \Debugbar::info($validationRules);
    // \Debugbar::info($validationResults);

    // home
    if ($id === NULL) $homeModel = new Home;
    else $homeModel = Home::findOrFail($id);
    $homeModel->homeName = $input['homeName'];
    $homeModel->availableTypes = $input['availableTypes'];
    $homeModel->layoutAvailable = implode(',', $input['layoutAvailable']);
    $homeModel->save();

    // rooms
    if (array_key_exists('rooms', $input)) {
      foreach ($input['rooms'] as $room) {
        if (!array_key_exists('id', $room)) $roomModel = new Room;
        else $roomModel = Room::findOrFail($room['id']);
        $roomModel->roomName = $room['roomName'];
        if (array_key_exists('roomImage', $room)) $roomModel->roomImage = $room['roomImage'];
        $roomModel->home_id = $homeModel->id;
        $roomModel->save();

        // materials
        if (array_key_exists('materials', $room)) {
          foreach ($room['materials'] as $material) {
            if (!array_key_exists('id', $material)) $materialModel = new Material;
            else $materialModel = Material::findOrFail($material['id']);
            $materialModel->materialName = $material['materialName'];
            $materialModel->room_id = $roomModel->id;
            $materialModel->save();

            // images
            if (array_key_exists('images', $material)) {
              foreach ($material['images'] as $image) {
                if (!array_key_exists('id', $image)) $imageModel = new Image;
                else $imageModel = Image::findOrFail($image['id']);
                $imageModel->fileName = $image['fileName'];
                $imageModel->material_id = $materialModel->id;
                $imageModel->save();
              }
            }
          }
        }
      }
    }

    return response()->json(['message' => true]);
  }

  public function delete ($id)
  {
    $home = Home::with('rooms.materials.images')->where('id', $id)->get()->pop();

    foreach($home->rooms as $room) {
      if ($room->roomImage) Storage::disk(env('FILE_DRIVER'))->delete($room->roomImage);

      foreach($room->materials as $material) {
        foreach($material->images as $image) {
          if ($image->fileName) Storage::disk(env('FILE_DRIVER'))->delete($image->fileName);
        }
      }
    }

    Home::destroy($id);

    return redirect('/');
  }

  public function getAvailable ()
  {
    $homes = Home::with('layouts')->get();
    return $homes->toJson();
  }

  public function attachLayout (Request $request, $id = NULL)
  {
    $input = $request->all();

    $where = [
      'layout_id' => $input['data']['layoutId'],
      'home_id' => $id
    ];

    $alreadySelected = \DB::table('home_layout')->where($where)->get();

    // TODO: This code is if we want to have multiple homes to multiple layout
    // \Debugbar::info($alreadySelected);
    // if (count($alreadySelected) > 0) {
    //   \DB::table('home_layout')->where($where)->delete();
    // } else {
    //   \DB::table('home_layout')->insert($where);
    // }

    $alreadySelected = \DB::table('home_layout')->where($where)->get();
    \DB::table('home_layout')->where([
      'layout_id' => $input['data']['layoutId'],
    ])->delete();
    if (count($alreadySelected) === 0) {
      \DB::table('home_layout')->insert($where);
    }

    return response()->json(['message' => true]);
  }
}