{!! Form::open(array('url'=>'admin/folders/create/'.$idTipo,'method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row "> 

<div class="col-xs-6 form-group">
	<div class="input-group">
        	<input type="text" class="form-control" name="searchText" placeholder="Buscar Por Cédula..." value="">
        	<!--	<input type="text" class="form-control" name="idTipo" value="{{$idTipo}}">-->
    		<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Buscar / Crear</button>
			</span>
</div>
</div>	
</div>
{!! Form::close()!!}