var dataCat;

var categorias = {
    init: function(dataString) {
        var self = this;
        console.log('Iniciando Categorias...');
    },
    crear: function(padre_id) {
        var self = this;
        $("#padre_id").val(padre_id);
        $("#accion").val("nuevo");
        $('#modalNodoNuevo').modal();
    },
    editar: function(nodo_id, nombre, tipo_id) {
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
    },

};
$(document).ready(function() {
    categorias.init(dataCat);
});