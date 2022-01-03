<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


$ftp_server="127.0.0.1";
$ftp_usuario="imcs";
$ftp_pass="123456";

$con_id=ftp_connect($ftp_server);

$lr=ftp_login($con_id, $ftp_usuario, $ftp_pass);

if ((!$con_id) || (!$lr) ) {
    echo 'No se pudo conectar.';
    exit;
} else {
    echo 'Conectado correctamente.';
    
    $temp = explode(".", $_FILES['archivo']['name']);

    $source_file = $_FILES['archivo']['tmp_name'];
    
    $nombre = $_FILES['archivo']['name'];

    $destino = 'archivos'.'/'.$nombre ;

    //ftp_pass($con_id, true);
    
   
    $subio = ftp_put($con_id, $destino, $source_file, FTP_BINARY);

    if ($subio) {
        echo "Se subió el archivo correctamente.";
    } else {
        echo "Ocurrió un error.";
    }
}
?>