@extends('admin.adminlte')
@section('content')
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{{$data['red']->nombre}}</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            {!! Form::open(array('url' => 'redes/nodo/'.$data['red']->id.'/'.$data['parent_id'], 'files' => true, 'id'=>'formulario')) !!}
            {!! Form::hidden('accion','crear', ['id'=>'accion']) !!}
            {!! Form::hidden('seguir','no', ['id'=>'seguir']) !!}
            {!! Form::hidden('red_id',$data['red']->id) !!}
            {!! Form::hidden('toma_id',$data['toma_id'], ['id'=>'toma_id']) !!}
            <div class="box-body">
              @foreach ($data['categorias'] as $categoria)
                <div class="form-group">
                  {!! Form::label('nodo['.$categoria->id.']', $categoria->nombre) !!}
                  <?php
                  switch ($categoria->tipo->nombre) {
                      case 'Buleano':
                          echo Form::checkbox('nodo['.$categoria->id.']', 1, null, array('class' => 'form-checkbox'));
                          break;
                      case 'Entero':
                      case 'Decimal':
                      case 'Porcentaje':
                          echo Form::number('nodo['.$categoria->id.']', null, array('class' => 'form-control'));
                          break;
                      case 'Texto Grande':
                          echo Form::textarea('nodo['.$categoria->id.']', null, array('class' => 'form-control'));
                          break;
                      case 'Fecha':
                          echo Form::text('nodo['.$categoria->id.']', null, array('class' => 'form-control datepicker'));
                          break;
                      case 'Fecha y Hora':
                          echo Form::text('nodo['.$categoria->id.']', null, array('class' => 'form-control datetimepicker'));
                          break;
                      case 'Hora':
                          echo Form::text('nodo['.$categoria->id.']', null, array('class' => 'form-control timepicker'));
                          break;
                      case 'Posición':
                          echo Form::text('nodo['.$categoria->id.'][lat]', null, array('class' => 'form-control nodo-lat'));
                          echo Form::text('nodo['.$categoria->id.'][lng]', null, array('class' => 'form-control nodo-lng'));
                          break;
                      case 'Imagen Local':
                      case 'Sonido Local':
                      case 'Video Local':
                      case 'Archivo':                      
                          echo Form::file('nodo['.$categoria->id.']', null, array('class' => 'form-control'));
                          break;
                      case 'Grupo':
                          //echo '<a href="'.url('redes/nodo/'.$data['red']->id.'/'.$categoria->id).'" class="btn btn-block btn-primary">'.$categoria->nombre.'</a>';
                          echo Form::button($categoria->nombre,['onclick'=>'nodos.ingresar(\''.$data['red']->id.'\',\''.$categoria->id.'\')', 'class'=>'btn btn-block btn-primary']);
                          break;
                      default:
                          echo Form::text('nodo['.$categoria->id.']', null, array('class' => 'form-control'));
                  }
                  ?>
              </div>
              @endforeach
            </div><!-- /.box-body -->
            <?php if ((count($data['categorias']) == 1) and ($data['categorias'][0]->tipo->nombre == 'Grupo')) {} else { ?>
            <div class="box-footer">
              <button type="button" onclick="nodos.guardarYSeguir()" class="btn btn-primary pull-right">Guardar y seguir</button>
              <button type="submit" class="btn btn-primary pull-right">Guardar</button>
            </div><!-- /.box-footer-->
            <?php } ?>
            {!! Form::close() !!}
          </div>
@endsection

@push('inscript')
<script type="text/javascript">
$(document).ready(function() {
  $('.datepicker').datepicker({
      format: 'mm/dd/yyyy'
  });
  $(".datetimepicker").datetimepicker({
      format: 'yyyy-mm-dd hh:ii',
      autoclose: true,
  });
  $(".timepicker").datetimepicker({
      startView: 0,
      maxView: 0,
      format: 'hh:ii',
      autoclose: true,
  });

  $('textarea').wysihtml5();  
});
</script>
<script src="{{ asset('/js/nodos.js') }}"></script>
<script src="{{ asset('/js/nodos-geo.js') }}"></script>
@endpush