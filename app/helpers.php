<?php
function renderNode($node) {
  $botones = '<div class="input-group-btn">
              <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-cog"></span> <span class="fa fa-caret-down"></span></button>
              <ul class="dropdown-menu">
                <li class="cursor"><a onclick="categorias.crear(\''.$node->id.'\');"><span class="fa fa-plus"></span> New Child</a></li>
                <li class="cursor"><a onclick="categorias.editar(\''.$node->id.'\',\''.$node->nombre.'\',\''.$node->tipo_id.'\');"><span class="fa fa-edit"></span> Edit</a></li>
                <li class="cursor"><a onclick="categorias.mover(\'izquierda\', \''.$node->id.'\')"><span class="fa fa-caret-up"></span> Move Up</a></li>
                <li class="cursor"><a onclick="categorias.mover(\'derecha\', \''.$node->id.'\')"><span class="fa fa-caret-down"></span> Move Down</a></li>
                <li class="divider"></li>
                <li class="cursor"><a onclick="categorias.eliminar(\''.$node->id.'\');"><span class="fa fa-minus"></span> Delete</a></li>
              </ul>
            </div>';
  if( $node->isLeaf() ) {
    return '<li>' . $botones . $node->nombre . '</li>';
  } else {
    $html = '<li>' . $botones . $node->nombre;
    $html .= '<ul>';
    foreach ($node->children as $child) $html .= renderNode($child);
    $html .= '</ul>';
    $html .= '</li>';
  }
  return $html;
}




function simplifica($node) {
  $nodo = array();
  if( !$node->isLeaf() ) {
    foreach ($node->children as $child) {
      $nodo[$child->id] = simplifica($child);
    }
  }
  return $nodo;
}

function procesarTomaTemp($node = null, $oNodo = null) {
  $nodo = $oNodo;
  if( !$node->isLeaf() ) {
    foreach ($node->children as $child) {
      $nodo[$child->id] = procesarTomaTemp($child);
    }
  }
  return $nodo;
}

function procesarToma($node = null, $oNodo = null) {
  $nodo = $oNodo;
  if( $node->isLeaf() ) {
    //if($oNodo->categoria_id == $node->id) $nodo[$node->id] = $oNodo;
  } else {
    foreach ($node->children as $child) {
      $nodo[$child->id] = procesarToma($child);
    }
  }

  if (is_array($oNodo)) {
    //$nodo = array();
  }

  return $nodo;
}

?>