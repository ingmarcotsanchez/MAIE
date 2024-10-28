var usu_id = $('#usu_idx').val();

function init(){
    $("#jornada_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#jornada_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Maie/controller/jornada.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#jornada_data').DataTable().ajax.reload();
            $('#modalcrearJornada').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta la Jornada',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#jornada_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Maie/controller/jornada.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Jornada');
    $('#jornada_form')[0].reset();
    $('#modalcrearJornada').modal('show');
}

function editar(jor_id){
    $.post("/Maie/controller/jornada.php?opc=mostrar",{jor_id:jor_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#jor_id').val(data.jor_id);
        $('#jor_nombre').val(data.jor_nombre);
    });
    $('#titulo_modal').html('Editar Jornada');
    $('#modalcrearJornada').modal('show');
}

function eliminar(jor_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar la Modalidad?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Maie/controller/jornada.php?opc=eliminar",{jor_id:jor_id},function (data){
                $('#jornada_data').DataTable().ajax.reload();
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
function est_act(jor_id){
    $.post("/Maie/controller/jornada.php?opc=activo",{jor_id:jor_id},function (data){
        $('#jornada_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(jor_id){
    $.post("/Maie/controller/jornada.php?opc=inactivo",{jor_id:jor_id},function (data){
        $('#jornada_data').DataTable().ajax.reload();
    });
}

init();