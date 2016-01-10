@extends('admin.adminlte')
@section('content')
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Redes</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            {!! Form::open(array('url' => 'redes/editar')) !!}
            {!! Form::hidden('id',$data['red']->id) !!}
            <div class="box-body">
              <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', $data['red']->nombre, array('class' => 'form-control')) !!}
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save changes</button>
            </div><!-- /.box-footer-->
            {!! Form::close() !!}
          </div>
@endsection

@push('inscript')
<!--<script src="{{ asset('/js/categorias.js') }}"></script>-->
@endpush