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
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

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

      /*  if (auth()->user()->role_id==1)
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
        }*/
        //and f.estado_Eliminar is null
        $users=DB::select('SELECT f.unidad, u.name, u.email, u.id, 
                            CASE  WHEN f.informe <> \'\' THEN COUNT(f.created_by_id) end as totInf,
                            case when (f.informe =\'\' or f.informe is null ) THEN COUNT(f.created_by_id) end as totNoI
                            from users u inner join folders f on f.created_by_id = u.id
                            where  f.tipo_ord= ? and f.estado_Eliminar is null 
                            GROUP by unidad, name,  email, id,informe',[$idTipo]);

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
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at',
            'folders.orden','folders.unidad','folders.tipo_ord','folders.informe', 'folders.detalle','users.name as respon')
           ->join('users','folders.created_by_id','=','users.id')
            ->where('folders.tipo_ord',$idTipo)
            ->where('folders.estado_Eliminar',null)
            ->where('users.id',auth()->user()->id)
           ->orderBy('folders.updated_at', 'desc')->get();
           //dd($folders);
           }
           else {
               //aquiiiiiiiiiiiiiiiiiiiiiiiiiii indec
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.detalle','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
                ->join('users','folders.created_by_id','=','users.id')
                ->where('folders.tipo_ord',$idTipo)
                ->where('folders.estado_Eliminar',null)
                ->where(function($q) {
                    $q->WhereNull('folders.informe')
                    ->orWhere('folders.informe','=','');})
                ->orderBy('folders.updated_at', 'desc')->get();
           
           }
           
        }   
   
        session(['ordenTipo'=> $idTipo]);
        $tipo=session('ordenTipo');
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
        
    return view('admin.folders.index', compact('folders','tipo','unidad'));
    }
    
   
    public function indexinforme($idTipo,$informe,$iduser,$unidad)
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
           if($informe==1){
          

            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at',
            'folders.orden','folders.unidad','folders.tipo_ord','folders.informe','folders.detalle','users.name as respon')
            ->join('users','folders.created_by_id','=','users.id')
            ->where('folders.unidad',$unidad)
            ->where('users.name',$iduser)
            ->where('folders.tipo_ord',$idTipo)
            ->where('folders.estado_Eliminar',null)
            ->whereRaw('LENGTH(folders.informe) > 0')
            //and  folders.informe <> ' '
            ->orderBy('folders.updated_at', 'desc')->get();
           

          }else {
            //  dd($iduser);
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at',
            'folders.orden','folders.unidad','folders.tipo_ord','folders.informe','folders.detalle','users.name as respon')
            ->join('users','folders.created_by_id','=','users.id')
            ->where('folders.unidad',$unidad)
            ->where('users.name',$iduser)
            ->where('folders.tipo_ord',$idTipo)
            ->where('folders.estado_Eliminar',null)
            ->where(function($q) {
            $q->WhereNull('folders.informe')
            ->orWhere('folders.informe','=','');})
            ->orderBy('folders.updated_at', 'desc')->get(); 

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
        $created_bies = \App\User::where('estado_Eliminar',null)->get()->pluck('orden','cedula','name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        
         $examenes = \App\Examenes::get()->pluck('detalle', 'detalle')->prepend(trans('quickadmin.qa_please_select'), '');
    
        $query=trim($request->get('searchText'));
       //
        
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
       
       $folders = null;
     //  $auxCedula=null;
     /*  if(!empty($query)){
         if($this->validarCedula($query)){
              $auxCedula=$query;              
              back()->with('msj', 'Cédula valida');
         }else{
          return back()->with('errormsj', 'Cédula no valida');
         }
      }*/
       $auxCedula=$query; 
      $folders = Folder::where('cedula',$query)
       ->where('estado_Eliminar',null)
      ->withTrashed()->get();
      
      if(!empty($query)){
        
        if(count($folders) == 0){
            $folders = collect([0=> new Folder]);
        }
    }
    
      $searchText='';
        return view('admin.folders.create', compact('created_bies','unidad','idTipoOrd','searchText','folders','examenes','auxCedula'));
    }

 
   public function store(StoreFoldersRequest $request)
    {
        if (! Gate::allows('folder_create')) {
            return abort(401);
        }
        
         $mytime = Carbon::now();
         $mytime->toDateString();
         $fechSistema=$mytime->format('d-m-Y');
         $var= 0;
        if(!empty($request)){
            $idSelec=$request->detalle;
            $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon','folders.detalle')
            ->join('users','folders.created_by_id','=','users.id')
            ->join('examenes','folders.detalle','=','examenes.detalle')
            ->where('tipo_ord',$request->tipo_ord)
            ->where('folders.estado_Eliminar',null)
            ->where('users.id',auth()->user()->id)
            ->where('folders.cedula',$request->cedula)->get();
            for($i=0; $i<count($folders); $i++){
                $date = $folders[$i]->updated_at->format('d-m-Y');
               // dd('fecha del sistema: '.$fechSistema);
                //print('fecha de la bd: '.$date);
                $detalle=$folders[$i]->detalle;
                
                   
                         
       // return back();
                   
            }
        }
         if($var == 0){
            $folder = Folder::create($request->all());
            $folders = Folder::select('folders.id','folders.cedula','folders.name',
            'folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon','examenes.detalle as detalle')
            ->join('users','folders.created_by_id','=','users.id')
            ->join('examenes','folders.detalle','=','examenes.detalle')
            ->where('tipo_ord',$folder->tipo_ord)
            ->where('users.id',auth()->user()->id)
           ->where('folders.estado_Eliminar',null)
            ->where('folders.cedula',$request->cedula)
            ->orderBy('updated_at', 'asc')->get();                      

        
        }else{
            $idTipoOrd=session('ordenTipo');
            $folders = Folder::select('folders.id','folders.cedula','folders.name',
            'folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon','examenes.detalle as detalle')
            ->join('users','folders.created_by_id','=','users.id')
            ->join('examenes','folders.detalle','=','examenes.detalle')
            ->where('tipo_ord',$request->tipo_ord)
            ->where('users.id',auth()->user()->id)
            ->where('folders.estado_Eliminar',null)
            ->where('folders.cedula',$request->cedula)
            ->orderBy('updated_at', 'asc')->get();

     
        }

//dd($folders);        
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
      
        $examenes = \App\Examenes::get()->pluck('detalle', 'detalle')->prepend(trans('quickadmin.qa_please_select'), '');
        
        $request->orden='';
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
        ->where('folders.estado_Eliminar',null)
        ->where('users.id',auth()->user()->id)
        ->orderBy('updated_at', 'desc')->get();
        
        
        
        
        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();
      
        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();
        
        if (Auth::getUser()->role_id==5)
        {
              $users=DB::select('SELECT f.unidad, u.name, u.email, u.id, 
                            CASE  WHEN f.informe <> \'\' THEN COUNT(f.created_by_id) end as totInf,
                            case when (f.informe =\'\' or f.informe is null ) THEN COUNT(f.created_by_id) end as totNoI
                            from users u inner join folders f on f.created_by_id = u.id
                            where  f.tipo_ord= ? and f.estado_Eliminar is null 
                            GROUP by unidad, name,  email, id,informe',[$folder->tipo_ord]);
             // $users = User::where('role_id','4')->get();
              /*return view('admin.folders.indexcliente', compact('users','unidad'));*/
                          return back()->withInput();

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
        $folder->estado_Eliminar='E';
        $folder->save();

       /*  $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon')
           ->join('users','folders.created_by_id','=','users.id')
        ->where('tipo_ord',$folder->tipo_ord)
        ->orderBy('informe')->get(); */

        $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.estado_Eliminar','folders.tipo_ord','folders.informe','users.name as respon')
        ->join('users','folders.created_by_id','=','users.id')
         ->where('folders.tipo_ord',session('ordenTipo'))
         ->where('folders.estado_Eliminar',null)
         ->where('users.id',auth()->user()->id)
        ->orderBy('folders.updated_at', 'desc')->get();


        $padre =  User::select('id_padre')
        ->where('id',Auth::getUser()->id)->get();

        $unidad = User::select('name')
        ->where('id',$padre[0]->id_padre)->get();

        $tipo=session('ordenTipo');
        
    //    return view('admin.folders.index',compact('folders','unidad'));
        return view('admin.folders.index', compact('folders','tipo','unidad'));
    }

/**
     * Remove Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminaOrden($id,$cedula)
    {
       
         $folder = Folder::findOrFail($id);
        $folder->estado_Eliminar='E';
        $folder->save();               


        $folders = Folder::select('folders.id','folders.cedula','folders.name','folders.updated_at','folders.orden','folders.unidad','folders.tipo_ord','folders.informe','users.name as respon','examenes.detalle as detalle')
        ->join('users','folders.created_by_id','=','users.id')
        ->join('examenes','folders.detalle','=','examenes.detalle')
        ->where('tipo_ord',session('ordenTipo'))
        ->where('users.id',auth()->user()->id)
        ->where('folders.estado_Eliminar',null)
        ->where('folders.cedula',$cedula)
        ->orderBy('updated_at', 'desc')->get();

         $idTipoOrd=session('ordenTipo');
        
        $searchText=$cedula;
      
      // return back()->withInput();
     //   return view('admin.folders.create',compact('folders','unidad'));
        return redirect()->route('crearord2',['idTipo' => $idTipoOrd,'searchText' =>$searchText]);
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
                $entry->estado_Eliminar='E';
                $entry->save();
                //$entry->delete();
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
    
     public function validarCedula(string $cedula)
    {
        // fuerzo parametro de entrada a string
        $cedula = (string)$cedula;

        // borro por si acaso errores de llamadas anteriores.
        $this->setError('');
       // dd($cedula);
        // validaciones
       try {
            $this->validarInicial($cedula, '10');
            $this->validarCodigoProvincia(substr($cedula, 0, 2));
            $this->validarTercerDigito($cedula[2], 'cedula');
            $this->algoritmoModulo10(substr($cedula, 0, 9), $cedula[9]);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }

    protected function validarInicial($cedula, $caracteres)
    {
        if (empty($cedula)) {
            throw new Exception('Valor no puede estar vacio');
        }

        if (!ctype_digit($cedula)) {
            throw new Exception('Valor ingresado solo puede tener dígitos');
        }

        //dd($caracteres);
        if (strlen($cedula) != $caracteres) {
           //print("Hola mundo Valor ingresado debe tener" .strlen($cedula)  .$caracteres );
            throw new Exception('Valor ingresado debe tener ');
        }

        return true;
    }

    protected function validarCodigoProvincia($numero)
    {
        if ($numero < 0 OR $numero > 24) {
            throw new Exception('Codigo de Provincia (dos primeros dígitos) no deben ser mayor a 24 ni menores a 0');
        }

        return true;
    }

    protected function validarTercerDigito($cedula, $tipo)
    {
        switch ($tipo) {
            case 'cedula':
            case 'ruc_natural':
                if ($cedula < 0 OR $cedula > 5) {
                    throw new Exception('Tercer dígito debe ser mayor o igual a 0 y menor a 6 para cédulas y RUC de persona natural');
                }
                break;
            case 'ruc_privada':
                if ($cedula != 9) {
                    throw new Exception('Tercer dígito debe ser igual a 9 para sociedades privadas');
                }
                break;

            case 'ruc_publica':
                if ($cedula != 6) {
                    throw new Exception('Tercer dígito debe ser igual a 6 para sociedades públicas');
                }
                break;
            default:
                throw new Exception('Tipo de Identificación no existe.');
                break;
        }

        return true;
    }

    protected function algoritmoModulo10($digitosIniciales, $digitoVerificador)
    {
        $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);

        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);

        $total = 0;
        foreach ($digitosIniciales as $key => $value) {

            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );

            if ($valorPosicion >= 10) {
                $valorPosicion = str_split($valorPosicion);
                $valorPosicion = array_sum($valorPosicion);
                $valorPosicion = (int)$valorPosicion;
            }

            $total = $total + $valorPosicion;
        }

        $residuo =  $total % 10;

        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 10 - $residuo;
        }

        if ($resultado != $digitoVerificador) {
            throw new Exception('Dígitos iniciales no validan contra Dígito Idenficador');
        }

        return true;
    }


    public function setError($newError)
    {
        $this->error = $newError;
        return $this;
    }
    
    
     public function heloo(){
        return 'hola';
    }
}
