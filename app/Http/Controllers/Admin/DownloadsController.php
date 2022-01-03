<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\MediaLibrary\Media;
use Carbon\Carbon;
use ZipArchive;

class DownloadsController extends Controller
{
    public function download($uuid) {
        if ( Auth::getUser()->id==null)
        {
            $user=2;
        }
        else
        {
            $user=Auth::getUser()->id==1;
        }
          
        $file = File::where([
            ['uuid', '=', $uuid]
         //   ['created_by_id', '=', $user]
            ])->first();
        
        $media = Media::where('model_id', $file->id)->first();
                                   
        $pathToFile = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $file->id . DIRECTORY_SEPARATOR . $media->file_name );

        return  response()->download($pathToFile);
    }

    public function imprimir($id){
        $today = Carbon::now()->format('d/m/Y');
      $informepdf = Folder::where('id', $id)->first();
        $pdf = \PDF::loadView('admin/folders/informe', compact('informepdf','today'));
        return $pdf->download('informe.pdf');
   }
  /*  
    public function descargaMasiva($seleccionados){
      //  $result = $request->input('id');
      $newArray = array($seleccionados);
     // $result = null;
       
      for($i=0; $i<count($newArray);$i++){
            $file = null;
            $file = File::where([ ['id', '=', $newArray[$i] ]])->first(); 
            $newArrayF = array($file->id);
            
           $result =array_push($newArrayF, $file);;
        }
        
     return  $result;
    }
    */ 
    public function descargaMasiva($seleccionados){
        //StoreFoldersRequest $request
        $lista = explode(",",$seleccionados);
        $zip = new ZipArchive();
        $max = count($lista);
        
       $zipname = time().".zip";
        $zip->open("IMCSDownload.zip",ZipArchive::CREATE);
     //   $dir = 'miDirectorio';
       // $zip->addEmptyDir($dir);  
       
        for($i=0; $i< count($lista);$i++){
            $media =  Media::select('file_name')->where('model_id',$lista[$i])->get();
            $resultado = preg_replace('([^A-Za-z0-9. ])', '', $media);
            $resultado = substr($resultado, 8);
          //  $pathToFile = '/home/egpvkkcjghgd/imcspacs/storage/app/public/711/usimage202005200012174555913.jpg';
            $pathToFile =storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $lista[$i] . DIRECTORY_SEPARATOR . $resultado );
            $zip->addFile($pathToFile);
            //$mediaConsult[] =  $pathToFile;
         
        }
        $zip->close();
        
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=IMCSDownload.zip");
        readfile('IMCSDownload.zip'); 
        unlink('IMCSDownload.zip');//Destruye el archivo temporal 
  //  return $mediaConsult;
    }
    
   
}
