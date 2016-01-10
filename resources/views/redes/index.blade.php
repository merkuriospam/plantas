@extends('admin.adminlte')
@section('content')
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Redes</h3>
              <a href="{{ url('redes/editar')}}" class="btn btn-xs btn-success">Nuevo</a>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="datos" class="table table-condensed">
                  <thead>
                  <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Action</th>
                  </tr>
                  </thead>
              </table>
            </div><!-- /.box-body -->
            <!--<div class="box-footer">
              Footer
            </div>--><!-- /.box-footer-->
          </div>
@endsection

@push('inscript')
<!--<script src="{{ asset('/js/categorias.js') }}"></script>-->
<script type="text/javascript">
    $(function() {
        $('#datos').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("redes/basic-data") }}'
        });
    });
</script>
@endpush