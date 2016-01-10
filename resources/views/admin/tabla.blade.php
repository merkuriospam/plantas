@extends('admin.adminlte')
@section('content')
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tabla</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                  <table id="ejemplo" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                      </tr>
                    </tfoot>
                  </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
              Footer
            </div><!-- /.box-footer-->
          </div>
@endsection

@section('inscript')
<script type="text/javascript">
      $(function () {
        $('#ejemplo').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });

        /*$('#ejemplo').dataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": $.fn.dataTable.pipeline( {
                url: '{{ url("admin/datosimple") }}',
                pages: 1 // number of pages to cache
            })
        });*/

      });

</script>
@endsection