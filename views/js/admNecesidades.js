var usu_id = $('#usu_idx').val();

function init(){
    $("#necesidades_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#necesidades_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/MAIE/controller/necesidades.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#necesidades_data').DataTable().ajax.reload();
            $('#modalcrearNecesidades').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta la Necesidad Educativa Especial',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#necesidades_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/MAIE/controller/necesidades.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

});

function nuevo(){
    $('#titulo_modal').html('Nueva Necesidad Educativa Especial');
    $('#necesidades_form')[0].reset();
    $('#modalcrearNecesidades').modal('show');
}

function editar(nec_id){
    $.post("/MAIE/controller/necesidades.php?opc=mostrar",{nec_id:nec_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#nec_id').val(data.nec_id);
        $('#nec_nombre').val(data.nec_nombre);
    });
    $('#titulo_modal').html('Editar Necesidad Educativa Especial');
    $('#modalcrearNecesidades').modal('show');
}

function eliminar(nec_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar Necesidad Educativa Especial?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/MAIE/controller/necesidades.php?opc=eliminar",{nec_id:nec_id},function (data){
                $('#necesidades_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }); 
        }
    });

}
function est_act(nec_id){
    $.post("/MAIE/controller/necesidades.php?opc=activo",{nec_id:nec_id},function (data){
        $('#necesidades_data').DataTable().ajax.reload();
    });
}

function est_ina(nec_id){
    $.post("/MAIE/controller/necesidades.php?opc=inactivo",{nec_id:nec_id},function (data){
        $('#necesidades_data').DataTable().ajax.reload();
    });
}

init();