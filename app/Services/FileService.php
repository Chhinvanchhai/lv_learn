<?php
namespace App\Services;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
class FileService {
    public function addFile(): JsonResponse {
        Storage::disk('local')->put('text/examplae.txt', 'just learn for iam not image some storage');
        $contents = Storage::get('text/examplae.txt');
        return response()-> json($contents);
    }
}
