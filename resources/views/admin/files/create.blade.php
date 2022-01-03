
@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
<link href="{{ url('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
.panel-default{

    width: 0px;
    
}

.card{
    border: 2px solid rgba(60, 141, 188, 0.781);
    width: 95%;    
}
</style>
@section('content')
    
    {!! Form::open(['method' => 'POST', 'route' => ['admin.files.store'], 'files' => true,]) !!}

    <div class="container">
        <div class="center" style="height:40px;color:white">
            <div class="col-md-6 col-lg-14">
                <div class="subscribe-text mb-20">
                    
                    <span>Telepacs  IMS / Área de 
                    @if(Session::get('ordenTipo')=="RX")
                     Rayos X 
                    @else
                        @if(Session::get('ordenTipo')=="ECO")
                         Ecografía 
                        @else
                        Tomografía                        
                     @endif                        
                    @endif
                    /{{Auth::getUser()->name}}/                    
            <!--<input type="button" value="Página anterior" onClick="history.go(-1);">-->                    
                </div>
            </div>              
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="page-title">Subir Imágenes</h3>
            </div>
            <div class="card-content">
                
            </div>
            <div class="center">
          
                <div class="col-xs-12 form-group">
                    <br>
                    {!! Form::label('folder_id', 'Paciente:', ['class' => 'control-label']) !!}
                    {!! Form::text('folder_id', $folders[0]->folder_id,['class' => 'form-control hidden','readonly' => 'readonly'  ]) !!}
                     {!! Form::text('name', $folders[0]->name,['class' => '','readonly' => 'readonly'  ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('folder_id'))
                        <p class="help-block">
                            {{ $errors->first('folder_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="center">
                <div class="col-xs-12 form-group">
                    {!! Form::label('filename', 'Archivos para Informe:', ['class' => 'control-label']) !!}
                    @if(Auth::getUser()->tipo_plan=='BASICO')
                    {!! Form::file('filename[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'filename',
                        'data-filekey' => 'filename',
                        'id' => 'my_id',
                         'onchange'=>'return fileValidation1()'
                        ]) !!}
                     @endif
                     
                      @if(Auth::getUser()->tipo_plan=='REGULAR')
                    {!! Form::file('filename[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'filename',
                        'data-filekey' => 'filename',
                        'id' => 'my_id',
                         'onchange'=>'return fileValidation1()'
                        ]) !!}
                     @endif
                     
                      @if(Auth::getUser()->tipo_plan=='DESTACADO')
                    {!! Form::file('filename[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'filename',
                        'data-filekey' => 'filename',
                        'id' => 'my_id',
                         'onchange'=>'return fileValidation1()'
                        ]) !!}
                     @endif
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group"></div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('filename'))
                        <p class="help-block">
                            {{ $errors->first('filename') }}
                        </p>
                    @endif
                    <h5 class="center">Solo Imágenes de 640x480*</h5>
                </div>
                
            </div>
           
           <a href="{{ route('tipoOrd',['idTipo' => Session::get('ordenTipo')]) }}" class="btn btn-danger">Volver órdenes</a>
           <div class="card-footer">
            
            
             {!! Form::text('folder_id', $folders[0]->id,['class' => 'invisible'  ]) !!}
              {!! Form::text('created_by_id', $folders[0]->created_by_id,['class' => 'invisible'  ]) !!}
                {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-primary', 'id' => 'submitBtn']) !!}
                {!! Form::close() !!}
           

@stop

           </div>

        </div>
    </div>


@section('javascript')
    @parent

    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
    
   $("#my_id").on('change', function() {
    if ($('#my_id').val()) { 
         $("#submitBtn").prop("disabled", false);
    }
});

    function fileValidation1(){
    var fileInput = document.getElementById('my_id');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.dcm)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo tiene permitidos extensions jpeg - jpg - DICOM');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                //document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                $('#imagePreview').attr('src',e.target.result);
            };
            reader.readAsDataURL(fileInput.files[0]);
           }
        }
    }
    
    function fileValidation2(){
    var fileInput = document.getElementById('my_id');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.bmp|.dcm)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo tiene permitidos extensions jpeg - jpg - png - bmp - DICOM ');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
           }
        }
    }
    
    function fileValidation3(){
    var fileInput = document.getElementById('my_id');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.bmp|.dcm|.)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Solo tiene permitidos extensions jpeg - jpg - png - bmp - DICOM ');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
           }
        }
    }

        $(function () {
            var exfiles = '<?php echo $userFilesCount; ?>';
            var existingFiles = Number(exfiles);


            $('input#my_id').change(function () {
                var uploadingFiles = $(this)[0].files;
                var totalCount = uploadingFiles.length + existingFiles;

                var Id = '<?php echo $roleId; ?>';
                var roleId = Number(Id);
                console.log(roleId);
console.log(totalCount);
               /*  if (totalCount > 5 && roleId == 2) {
                    alert("your upload limit is 5 files." +
                            "Upgrade to Premium and upload as many files you want");
                    $('.file-upload').each(function () {
                        var $this = $(this);

                        $(this).fileupload({
                            dataType: 'json',
                            formData: {
                                model_name: 'File',
                                bucket: $this.data('bucket'),
                                file_key: $this.data('filekey'),
                                _token: '{{ csrf_token() }}'

                            },

                            add: function (e, data) {
                                data.abort();
                            }
                        })
                    });
                    document.getElementById("submitBtn").classList.add('disabled');
                } */
            });

            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'File',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'

                    },

                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                                'width',
                                '0%'
                        );
                    }

                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                            'width',
                            progress + '%'
                    );
                });

            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    
    
    </script>
@stop