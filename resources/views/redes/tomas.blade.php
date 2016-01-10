<?php //dd($data['red']); ?>

@extends('front.tomas')
@section('content')

<div class="row">
  <div class="col-md-12">

    @if (count($data['red'])>0)
    <h1>{{ $data['red']->nombre }}</h1>
    <div class="contenedor_tomas">
      @forelse($data['red']->tomas as $toma)

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">{{ $toma->nombre }}</h3>
        </div>
        <div class="panel-body">
          @forelse($toma->nodos as $nodo)
            <?php
            $valor = '-';
            switch ($nodo->tipo_id) {
              case '8':  //Sonido Local
              case '10': //Imagen Local
              case '12': //Video Local
              case '19': //Archivo
                ?><img src="{{ asset('/uploads/'.$nodo->recurso->filename) }}"><?php
                break;
              case '15': //Fecha
                $valor = $nodo->v_fecha;
                break;
              case '16': //Fecha Y Hora
              case '17': //Hora
                $valor = $nodo->v_fecha_hora;
                break;
              case '9':  //Sonido Externo
              case '11': //Imagen Externa
              case '13': //Video Externo
              case '14': //URL
                $valor = $nodo->v_url;
                break;
              case '1': //Buleano
                $valor = $nodo->v_buleana;
                break;
              case '2': //Entero
                $valor = $nodo->v_entero;
                break;
              case '3': //Decimal
              case '6': //Porcentaje
                $valor = $nodo->v_decimal;
                break;
              case '5': //Texto Grande
                $valor = $nodo->v_texto_grande;
                break;
              case '19': //Archivo no hago nada porque se procesa anteriormente
                break;
              case '7': //Posición
                $lat = $nodo->lat;
                $lng = $nodo->lng;
                break;
              default:
                $valor = $nodo->v_texto;
                break;
            }
            ?>
              <p class="media-heading">{{ $nodo->categoria->nombre }}: {{ $valor }}</p>

          @empty
              <p class="media-heading">Sin resultados</p>
          @endforelse
        </div>
      </div>
      @empty
      <div class="panel panel-default">
        <div class="panel-body">
          Sin resultados
        </div>
      </div>
      @endforelse
    </div>
    @else
    <p>Sin resultados</p>
    @endif

  </div>
</div>

@endsection

@push('inscript')
<!--<script src="{{ asset('/js/categorias.js') }}"></script>-->
@endpush