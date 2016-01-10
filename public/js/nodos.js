var nodos = {
    init: function(dataString) {
        var self = this;
        console.log('Iniciando Nodos...');
    },
    guardarYSeguir: function() {
        $("#seguir").val('si');
        $("#formulario").submit();
    },
    ingresar: function(red_id, categoria_id) {
        $("#formulario").attr('action', WEBROOT_URL+'/redes/nodo/'+red_id+'/'+categoria_id);
        $("#accion").val('ingresar');
        $("#formulario").submit();
    },

    /*editar: function(nodo_id, nombre, tipo_id) {
        var self = this;
        $("#nodo_id").val(nodo_id);
        $("#nombre").val(nombre);
        $("#tipo_id").val(tipo_id);
        $("#accion").val('editar');
        $('#modalNodoNuevo').modal();
    },
    mover: function(direccion, nodo_id) {
        var self = this;
        $.ajax
        ({
            type: "POST",
            url: WEBROOT_URL + "/categorias",
            data: "accion=mover&direccion="+direccion+"&nodo_id="+nodo_id,
            cache: false,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
              alert("No se puede mover el nodo");
            }
        });    
    },
    eliminar: function(nodo_id) {
        var self = this;
        $.ajax
        ({
            type: "POST",
            url: WEBROOT_URL + "/categorias",
            data: "accion=eliminar&nodo_id="+nodo_id,
            cache: false,
            success: function(response) {
                location.reload();
            }
        });    
    },*/
};
$(document).ready(function() {
    nodos.init();
});