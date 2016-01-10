@extends('admin.adminlte')
@section('content')
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Nodos</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="categorias">
                <?php foreach($data['categorias'] as $node): ?>
                  <?php echo renderNode($node); ?>
                <?php endforeach; ?>
              </ul>
            </div><!-- /.box-body -->
            <!--<div class="box-footer">
              Footer
            </div>--><!-- /.box-footer-->
          </div>
          <!-- Modal -->
          <div id="modalNodoNuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            {!! Form::open(array('url' => 'categorias')) !!}
            {!! Form::hidden('red_id',$data['red_id'], array('id' => 'red_id')) !!}
            {!! Form::hidden('accion','', array('id' => 'accion')) !!}
            {!! Form::hidden('nodo_id','0', array('id' => 'nodo_id')) !!}
            {!! Form::hidden('padre_id','0', array('id' => 'padre_id')) !!}
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Nodo</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', '', array('class' => 'form-control', 'placeholder' => 'Enter')) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('tipo_id', 'Tipo') !!}
                    {!! Form::select('tipo_id', $data['tipos'], '', array('class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
          <!--<pre><?php //print_r($data); ?></pre>-->
@endsection

@push('inscript')
<script src="{{ asset('/js/categorias.js') }}"></script>
@endpush