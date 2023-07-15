<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Google\Cloud\Storage\StorageClient;

class ImageController extends Controller
{
    // countrutor()
    public function updateImage(Request $request){


          $image = $request->file('image'); //image file from frontend

          $student   = app('firebase.firestore')->database()->collection('images')->document('defT5uT7SDu9K5RFtIdl');
          $firebase_storage_path = 'images/';
          $name     = $student->id();
          $localfolder = public_path('firebase-temp-uploads') .'/';
          $extension = $image->getClientOriginalExtension();
          $file      = $name. '.' . $extension;
          if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            //will remove from local laravel folder
            unlink($localfolder . $file);
          }
          return response()->json([
            "status" => 200,
          ]);
    }
}
