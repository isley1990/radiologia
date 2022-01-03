<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
        /*body{
          background-image: url('http://imcspacs.resonanciamagneticaguayaquil.com/imagen/logop.jpg');
           opacity:0.6; 
          background-repeat: no-repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        }*/
        footer {
         
          position: absolute;
          bottom: 2;
          width: 100%;
          height: 200px;
          color: white;
        }
        
        </style>
    </head>
    <body>
    <div style="background-image: url('http://imcspacs.resonanciamagneticaguayaquil.com/imagen/head.jpg');
     width: 100%;
    height: 8%;
    padding-top: 0%;
           background-repeat: no-repeat;  background-position: center;">
       
    </div>  
       
        <hr>
        <div class="contenido">
        <p>Paciente: {{$informepdf->name}}</p>
        <p>Fecha: {{date('Y-m-d H:i:s')}} </p>
        <p>Informe:</p>

     
        <p><?=str_replace('_', ' ', $informepdf->informe)?></p>           
   <footer>
    <div style="background-image: url('http://imcspacs.resonanciamagneticaguayaquil.com/imagen/bot.jpg');
     width: 100%;
    height: 15%;
   
           background-repeat: no-repeat;  background-position: center;">
       
    </div>
    </footer>
    </body>
    
</html>

   
