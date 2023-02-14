<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Services\FileService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ResourceImport;

class FileControler extends Controller
{
    public function __construct(private FileService $fileService)
    {
    }
    public function addFile(Request $request){
        $this->validate($request, [
            'file' => 'required|max:2048',
        ]);
        $part = '';
        $filename = $request->file('file');
        // print_r($request->file('file'));
        $ext = $filename->getClientOriginalExtension();
        if(  $ext == 'xlsx') {
            (new ResourceImport)->import( $filename);
        } else {
            $part =  env('APP_URL').'storage/'.$filename->store('resources', 'public');
            Resource::create(['url' =>  $part , 'user_id' => 1]);
        }
        return response() -> json([$part,   $ext]);
    }
}
