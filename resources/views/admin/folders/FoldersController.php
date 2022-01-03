<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\File;
use App\Folder;
use App\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class FoldersController extends Controller
{
    /**
     * Display a listing of Folder.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
    
    
    
    
     public function indexclientes($idTipo)
    {
        if (! Gate::allows('folders_clientes')) {
            return abort(401);
        }

        if (auth()->user()->role_id==1)
        {
            $users = User::All();
        }
        else {

            if (auth()->user()->role_id==5){
                $users = User::where('role_id','4')->get();
             //  dd($users);
            }
            else {
                $users = User::where('id_padre',auth()->user()->id)->get();
            }
        }

             session(['ordenTipo'=> $idTipo]);
        return view('admin.folders.indexcliente', compact('users'));
    }


    public function index($idTipo)
    {
        if (! Gate::allows('folder_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Folder.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Folder.filter', 'my');
            }
        }
   //    dd($filterBy);

        if (request('show_deleted') == 1) {
            if (! Gate::allows('folder_delete')) {
                return abort(401);
            }
            $folders = Folder::onlyTrashed()->get();
        } else {
           // $folders = Folder::all();
           $user='1298955555';
           
           if (auth()->user()->role_id==2){
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
           ->join('users','folders.created_by_id','=','users.id')
            ->where('folders.tipo_ord',$idTipo)
            ->where('users.id',auth()->user()->id)
           ->orderBy('folders.informe')->get();
           }
           else {
               // dd($user);
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
            ->join('users','folders.created_by_id','=','users.id')
            ->where('folders.tipo_ord',$idTipo)
            ->whereNull('folders.informe')
           ->orWhere('folders.informe','')
            ->orderBy('folders.informe')->get();
           }
           
        }   
   
        session(['ordenTipo'=> $idTipo]);

    $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
        
    return view('admin.folders.index', compact('folders','tipo','unidad'));
    }
    
   
    public function indexinforme($idTipo,$idrol,$iduser)
    {
       
        if (! Gate::allows('folder_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Folder.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Folder.filter', 'my');
            }
        }
        

        if (request('show_deleted') == 1) {
            if (! Gate::allows('folder_delete')) {
                return abort(401);
            }
            $folders = Folder::onlyTrashed()->get();
        } else {
           // $folders = Folder::all();
           $user='1298955555';
           if ($idrol==1){
            //  dd($idrol);
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.detalle','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
           ->join('users','folders.created_by_id','=','users.id')
            ->where('folders.unidad',$iduser)
            ->where('folders.tipo_ord',$idTipo)
        //  ->where(function($q) {
           // $q->WhereNotNull('folders.informe')
            ->whereRaw('LENGTH(folders.informe) > 0')
        ->orderBy('folders.informe')->get();   
           }
           else {
           //   dd($idTipo);
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.detalle','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
            ->join('users','folders.created_by_id','=','users.id')
             ->where('folders.unidad',$iduser)
            ->where('folders.tipo_ord',$idTipo)
            ->where(function($q) {
            $q->WhereNull('folders.informe')
            ->orWhere('folders.informe','=','');})
        ->orderBy('folders.informe')->get();    
           }
           
        }   
   // dd($user);
       
 
  $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
        
         session(['ordenTipo'=> $idTipo]);
        $tipo=session('ordenTipo');
        
    return view('admin.folders.indexinformante', compact('folders','tipo','unidad'));
    }
    
   
    
    public function create(Request $request, $idTipo)
    {
        if (! Gate::allows('folder_create')) {
            return abort(401);
        }
        $idTipoOrd= $idTipo;
    //   dd($idTipoOrd);
        $created_bies = \App\User::get()->pluck('orden','cedula','name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        
         $examenes = \App\Examenes::get()->pluck('detalle', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        
        $query=trim($request->get('searchText'));
       // dd($query);
        
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
       
       $folders = Folder::where('cedula',$query)
       ->withTrashed()->get();
    
      $searchText='';
        return view('admin.folders.create', compact('created_bies','unidad','idTipoOrd','searchText','folders','examenes'));
    }

 
   public function store(StoreFoldersRequest $request)
    {
        if (! Gate::allows('folder_create')) {
            return abort(401);
        }
        $folder = Folder::create($request->all());
        
        $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon','examenes.detalle as detalle')
        ->join('users','folders.created_by_id','=','users.id')
        ->join('examenes','folders.detalle','=','examenes.id')
        ->where('tipo_ord',$folder->tipo_ord)
        ->where('users.id',auth()->user()->id)
        ->where('folders.cedula',$request->cedula)
        ->orderBy('informe')->get();
        
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
      
        $examenes = \App\Examenes::get()->pluck('detalle', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        
        $idTipoOrd=session('ordenTipo');
        return view('admin.folders.create',compact('folders','unidad','idTipoOrd','examenes'));
    }

    public function edit($id)
    {
       // dd($id);
        if (! Gate::allows('folder_edit')) {
            return abort(401);
        }

     //   $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

     //   $folder = Folder::findOrFail($id);

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$files = \App\File::where('folder_id', $id)->get();

        $folder = Folder::findOrFail($id);
        $userFilesCount = File::where('created_by_id', Auth::getUser()->id)->count();

        $plantillasLista = Plantilla::get()->pluck('nombre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $plantillaTolal = Plantilla::all();
      //  $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.folders.edit', compact('folder', 'files', 'userFilesCount','plantillasLista','plantillaTolal'));
     //  dd($created_bies);
   //     return view('admin.folders.edit', compact('folder', 'created_bies'));
    }

    /**
     * Update Folder in storage.
     *
     * @param  \App\Http\Requests\UpdateFoldersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoldersRequest $request, $id)
    {
        if (! Gate::allows('folder_edit')) {
            return abort(401);
        }
        $folder = Folder::findOrFail($id);
        $folder->update($request->all());

          $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
        ->join('users','folders.created_by_id','=','users.id')
        ->where('tipo_ord',$folder->tipo_ord)
        ->where('users.id',auth()->user()->id)
        ->orderBy('informe')->get();
        
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
        
        if (Auth::getUser()->role_id==5)
        {
            
              $users = User::where('role_id','4')->get();
              return view('admin.folders.indexcliente', compact('users','unidad'));
            
        }
        else
        {
        return view('admin.folders.index',compact('folders','unidad'));
        }
       
    }

    public function tipos(){
        $tipoOrden=1;
        return view('admin.folders.menutipos',compact('tipoOrden','2'));
    }

    public function show($id)
    {
        if (! Gate::allows('folder_view')) {
            return abort(401);
        }
        
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $files = \App\File::where('folder_id', $id)->get();

        $folder = Folder::findOrFail($id);
        $userFilesCount = File::where('created_by_id', Auth::getUser()->id)->count();

        return view('admin.folders.show', compact('folder', 'files', 'userFilesCount'));
    }


    /**
     * Remove Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::findOrFail($id);
        $folder->delete();

       /*  $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
           ->join('users','folders.created_by_id','=','users.id')
        ->where('tipo_ord',$folder->tipo_ord)
        ->orderBy('informe')->get(); */

        $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
        ->join('users','folders.created_by_id','=','users.id')
         ->where('folders.tipo_ord',session('ordenTipo'))
         ->where('users.id',auth()->user()->id)
        ->orderBy('folders.informe')->get();

        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();

        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();

        $tipo=session('ordenTipo');
        
    //    return view('admin.folders.index',compact('folders','unidad'));
        return view('admin.folders.index', compact('folders','tipo','unidad'));
    }

    public function eliminaOrden($id,$cedula)
    {
      
    //  dd($cedula);
      
       
        $folder = Folder::findOrFail($id);
        $folder->delete();

       /*  $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
           ->join('users','folders.created_by_id','=','users.id')
        ->where('tipo_ord',$folder->tipo_ord)
        ->orderBy('informe')->get(); */

        $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon','examenes.detalle as detalle')
        ->join('users','folders.created_by_id','=','users.id')
        ->join('examenes','folders.detalle','=','examenes.id')
        ->where('tipo_ord',session('ordenTipo'))
        ->where('users.id',auth()->user()->id)
        ->where('folders.cedula',$cedula)
        ->orderBy('informe')->get();

        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();

        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();

        $tipo=session('ordenTipo');
       
        return back();
     //   return view('admin.folders.create',compact('folders','unidad'));
     //   return view('crearord2', compact('tipo','cedula'));
    }

   
    /**
     * Delete all selected Folder at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Folder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->restore();

        $tipoOrden=1;
     //   return view('admin.folders.menutipos',compact('tipoOrden'));
    }

    /**
     * Permanently delete Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('folder_delete')) {
            return abort(401);
        }
        $folder = Folder::onlyTrashed()->findOrFail($id);
        $folder->forceDelete();

        $tipoOrden=1;
     //   return view('admin.folders.menutipos',compact('tipoOrden'));
    }
}
