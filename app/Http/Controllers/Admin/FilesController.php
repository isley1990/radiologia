<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilesRequest;
use App\Http\Requests\Admin\UpdateFilesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Faker\Provider\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class FilesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of File.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('file_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('File.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('File.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (!Gate::allows('file_delete')) {
                return abort(401);
            }
            $files = File::onlyTrashed()->get();
        } else {
            $files = File::all();
        }
        $user = Auth::getUser();
        $userFilesCount = File::where('created_by_id', $user->id)->count();

        return view('admin.files.index', compact('files', 'userFilesCount'));
    }

    /**
     * Show the form for creating new File.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $folder_id=$request->input('folder_id');
        if (!Gate::allows('file_create')) {
            return abort(401);
        }
        
        $auxFrm=0;
        if(auth()->user()->role_id==5){
            $auxFrm=1;
        }
        $roleId = Auth::getUser()->role_id;
       
        $userFilesCount = File::where('created_by_id', Auth::getUser()->id)->count();
       /*  if ($roleId == 2 && $userFilesCount > 5) {
            return redirect('/admin/files/');
        } */

        $folders = \App\Folder::where('id',$folder_id)->get();
       
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.files.create', compact('folders', 'created_bies', 'userFilesCount', 'roleId','auxFrm'));
    }

    /**
     * Store a newly created File in storage.
     *
     * @param  \App\Http\Requests\StoreFilesRequest $request
     * @return \Illuminate\Http\Response
     */
        public function store(StoreFilesRequest $request)
    {
        if (!Gate::allows('file_create')) {
            return abort(401);
        }
        if ($request->input('filename_id')==null){
         
          return back();
        }
        
       
            $request = $this->saveFiles($request);
           
            $data = $request->all();
            $fileIds = $request->input('filename_id');
           
            foreach ($fileIds as $fileId) {

                $file = new FILE;
                $file->id = $fileId;
                $file->uuid = (string)\Webpatser\Uuid\Uuid::generate();
                $file->folder_id = $request->input('folder_id');
                $file->created_by_id = $request->input('created_by_id');
                $file->save();
            }
           
           
           
            foreach ($request->input('filename_id', []) as $index => $id) {
                $model = config('laravel-medialibrary.media_model');
                $file = $model::find($id);
                $file->model_id = $file->id;
                $file->save();
            }
     
         
            $idTipo=session('ordenTipo');
            return redirect()->route('imagenes', $request->input('folder_id'));
         //   return view('tipoOrd')->with('idTipo', $idTipo);

    }


    public function update(UpdateFilesRequest $request, $id)
    {
        if (!Gate::allows('file_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $file = File::findOrFail($id);
        $file->update($request->all());


        $media = [];
        foreach ($request->input('filename_id', []) as $index => $id) {
            $model = config('laravel-medialibrary.media_model');
            $file = $model::find($id);
            $file->model_id = $file->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $file->updateMedia($media, 'filename');

        return redirect()->route('admin.files.index');
    }


    /**
     * Display File.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove File from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$pac)
    {
    //    dd($pac);
        if (!Gate::allows('file_delete')) {
            return abort(401);
        }
        $file = File::findOrFail($id);
        $file->deletePreservingMedia();
      
        $files = \App\File::where('folder_id', $pac)->get();

        $folder = Folder::findOrFail($pac);
        $userFilesCount = File::where('created_by_id', Auth::getUser()->id)->count();

        return view('admin.folders.show', compact('folder', 'files', 'userFilesCount'));
      //  return redirect()->route('admin.folders.show');
    }

    /**
     * Delete all selected File at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('file_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = File::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore File from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('file_delete')) {
            return abort(401);
        }
        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();

        return redirect()->route('admin.files.index');
    }

    /**
     * Permanently delete File from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('file_delete')) {
            return abort(401);
        }
        $file = File::onlyTrashed()->findOrFail($id);
        $file->forceDelete();

        return redirect()->route('admin.files.index');
    }
}
