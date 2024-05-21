<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class uploadController extends Controller
{
    public function uploadLargeFiles(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('media', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/' . $path),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
    public function tmpUploads(Request $request ,$key)
    {

        $keys = array_keys($request->all());
        foreach ($keys as $name){
           if($request->hasFile($name)){
               $paths =  $request->file($name)->store($key, 'public');
           }
        }
        return $paths;

        // $file = $request->file('file');

        // if ($request->hasFile('file1')) {

        //     $path =  $request->file('file1')->store('lessons', 'public');
        // }
        // return $path;
    }
    public function tmpUploadsDelete(Request $request,$key)
    {

        $path = $request->getContent();
        Storage::disk('public')->delete($path);

        return response()->json(['path' => $path]);
    }
    public function tmpUploadsrefrsh(Request $request)
    {
        $path = $request->file;

        if ($path == null) {
            return response()->json(['message' => 'file not found']);
        }


        Storage::disk('public')->delete($path);

        return response()->json(['message' => 'file deleted']);
    }

    // public function tmpUploadsRestore(Request $request,$key)
    // {
    //     dd($request->getContent(),$key);
    //     $path = $request->getContent();
    //     $path = Storage::disk('public')->url($path);

    //     return $path;
    // }

    public function tmpUploadsload(Request $request,$folder)
    {
        $fileId = request('fileId');
        dd($fileId);
    }
}
