<?php
//VISTA DE HOME LOGIN
Route::get('/', function () { return redirect('/admin/home'); });

//Route::get('/subir', function () {
    //return view('create');
//});
//VISTA CREAR NUEVA ORDEN MEDICO OPERADOR DE IMAGENES
Route::post('admin/files/create', 'Admin\FilesController@create')->name('cargaimg');
//VISTA INFORMES PARA CONTROLAR LOS DOCUMENTOS Y REGISTROS
$this->get('admin/folders/index/{idTipo}', 'Admin\FoldersController@index')->name('tipoOrd');
//VISTA IMAGENES POR ORDEN DEL PACIENTE 
$this->get('imagen/{idfolder}', 'Admin\FoldersController@show')->name('imagenes');
//VISTA DE ORDEN POR USUARIOS DE CADA INSTITUCION INFORMADOS SOLO DEL MEDICO OPERADOR
$this->get('admin/folders/index/{idTipo}/{informe}/{iduser}/{unidad}', 'Admin\FoldersController@indexinforme')->name('verinforme');
//VISTA CREAR NUEVA ORDEN MEDICO OPERADOR
$this->get('admin/folders/create/{idTipo}', 'Admin\FoldersController@create')->name('crearord');
//CONTROLADOR DEL BUSCADOR DE CEDULAS DE LA VISTA DEL OPERADOR EN CREAR ORDENES
$this->get('admin/folders/create/{idTipo}?searchText={searchText}', 'Admin\FoldersController@create')->name('crearord2');
//VISTA GENERAL DE LOS INFORMES PENDIENTES DEL MEDICO INFORMANTE
$this->get('admin/folders/{idTipo}', 'Admin\FoldersController@indexclientes')->name('clientes');
//VISTA A LOS MODELOS DE PLANTILLLAS DE LA VISTA ADMINISTRADOR 
$this::get('admin/plantillas', 'Admin\plantillaController@index')->name('plantillasMenu');
//VISTA PARA CREAR NUEVAS PLANTILLAS DE LA VISTA ADMIN
//$this::get('admin/plantillas', 'Admin\plantillaController@create');
//RUTA DE ACCESO PARA LA VIEW
Route::get('admin/plantillas/create', 'Admin\plantillaController@create')->name('crear');
//RUTA DE ACCESO PARA LA EDIT
Route::get('admin/plantillas/edit/{id}', 'Admin\plantillaController@edit')->name('editar');
//RUTA DE ACCESO PARA IMPRIMIR INFORMES
Route::get('admin/folders/informe/{id}', 'Admin\DownloadsController@imprimir')->name('imprimir');
//RUTA DE ACCESO PARA VER PLANTILLAS VIEW
Route::post('admin/plantillas/store', 'Admin\plantillaController@store')->name('ver');
//RUTA DE ACCESO PARA ACTUALIZAR PLANTILLAS VIEW
Route::put('admin/plantillas/update/{id}', 'Admin\plantillaController@update')->name('actualizar');
//RUTA DE ACCESO PARA LAS FOLDERS OSEA LOS INFORMES EN EL MENU EJEMPLO: ECO, RX ETC
Route::get('folders', 'Admin\FoldersController@tipos')->name('tiposmenu');
//RUTA DE ACCESO PARA EL COMANDO BORRAR 
Route::delete('admin/files/{id}/{pac}', 'Admin\FilesController@destroy')->name('eliminafile');
//RUTA DE ACCESO PARA VISOR DE IMAGENES WEASIS
Route::get('verWeasis/{id}', 'Admin\FoldersController@verWeasisImage')->name('weasis');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

$this->delete('borrad/{id}/{cedula}', 'Admin\FoldersController@eliminaOrden')->name('elimOrden');
// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

//Route::post('/downloadMasiva','Admin\DownloadsController@descargaMasiva')->name('downloadMasiva');
Route::get('/downloadMasiva/{seleccionados}', 'Admin\DownloadsController@descargaMasiva');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //RUTA DEL CONTROLADOR DE LA VISTA HOME
    Route::get('/home', 'HomeController@index');
    //RUTA DE RECURSOS DE SUSCRIPCION
    Route::resource('subscriptions', 'Admin\SubscriptionsController');
    //RUTA DE PAGOS
    Route::resource('payments', 'Admin\PaymentsController');
    //RUTA DE ROLES EN LA VISTA ADMIN
    Route::resource('roles', 'Admin\RolesController');
    
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    //Route::post('download_mass_Download', ['uses' => 'Admin\DownloadsController@massDownload', 'as' => 'download.mass_Download'])->name('descargarImage');
    Route::resource('users', 'Admin\UsersController');
    
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    
    Route::resource('/admin/folders', 'Admin\FoldersController');
   
    Route::post('folders_mass_destroy', ['uses' => 'Admin\FoldersController@massDestroy', 'as' => 'folders.mass_destroy']);
  
    Route::post('folders_restore/{id}', ['uses' => 'Admin\FoldersController@restore', 'as' => 'folders.restore']);
  
    Route::delete('folders_perma_del/{id}', ['uses' => 'Admin\FoldersController@perma_del', 'as' => 'folders.perma_del']);
  
    Route::resource('files', 'Admin\FilesController');
  
    Route::get('{uuid}/download', 'Admin\DownloadsController@download');
  //  Route::get('/massDownload', 'Admin\DownloadsController@massDownload')->name('decargar');
    Route::post('files_mass_destroy', ['uses' => 'Admin\FilesController@massDestroy', 'as' => 'files.mass_destroy']);
    Route::post('files_restore/{id}', ['uses' => 'Admin\FilesController@restore', 'as' => 'files.restore']);
    Route::delete('files_perma_del/{id}', ['uses' => 'Admin\FilesController@perma_del', 'as' => 'files.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');
   
//   Route::get('downloadMasiva/{files}',  ['uses' =>  'Admin\DownloadsController@descargaMasiva', 'as' => 'downloadMasiva']);
  
});
