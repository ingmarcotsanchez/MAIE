var usu_id = $('#usu_idx').val();

function init(){
    $("#profesor_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#profesor_form")[0]);
    console.log(formData);
    var totalfiles = $('#fileElem').val().length;
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
    $.ajax({
        url: "/Maie/controller/profesor.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#profesor_data').DataTable().ajax.reload();
            $('#modalcrearProfesor').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#rol_id').select2({
        dropdownParent: $('#modalcrearProfesor')
    });
    $('#esc_id').select2({
        dropdownParent: $('#modalcrearProfesor')
    });

    combo_rol();
    combo_escalfon();

    $('input#prof_dni').keypress(function (event) {
        if (event.which < 48 || event.which > 57 || this.value.length === 10) {
          return false;
        }
    });

    $("#prof_dni").on("keyup", function() {
        var prof_dni = $("#prof_dni").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCedula = $("#prof_dni").val().length; //CUENTO LONGITUD
      
      //Valido la longitud 
        if(longitudCedula >= 8){
            var dataString = 'prof_dni=' + prof_dni;
      
            $.ajax({
                url: '/Maie/views/js/verificarCedula.php',
                type: "GET",
                data: dataString,
                dataType: "JSON",
      
                success: function(datos){
      
                    if( datos.success == 1){
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',true);
                        $("select").attr('disabled',true);
                        $("input#prof_dni").attr('disabled',false);
                        $("button").attr('disabled',true);
      
                    }else{
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',false);
                        $("select").attr('disabled',false);
                        $("button").attr('disabled',false);
      
                    }
                }
            });
        }
    });
              

    $('#profesor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Maie/controller/profesor.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Profesor');
    $('#profesor_form')[0].reset();
    $('#modalcrearProfesor').modal('show');
}

function editar(prof_id){
    $.post("/Maie/controller/profesor.php?opc=mostrar",{prof_id:prof_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#prof_id').val(data.prof_id);
        $('#prof_dni').val(data.prof_dni);
        $('#prof_nom').val(data.prof_nom);
        $('#prof_ape').val(data.prof_ape);
        $('#prof_correo').val(data.prof_correo);
        $('#prof_niv').val(data.prof_niv);
        $('#prof_sex').val(data.prof_sex);
        $('#prof_telf').val(data.prof_telf);
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#esc_id').val(data.esc_id).trigger('change');
        $('#prof_est').val(data.prof_est);
    });
    $('#titulo_modal').html('Editar Profesor');
    $('#modalcrearProfesor').modal('show');
}

function prof_act(prof_id){
    $.post("/Maie/controller/profesor.php?opc=activo",{prof_id:prof_id},function (data){
        $('#profesor_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function prof_ina(prof_id){
    $.post("/Maie/controller/profesor.php?opc=inactivo",{prof_id:prof_id},function (data){
        $('#profesor_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}


function eliminar(prof_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Maie/controller/profesor.php?opc=eliminar",{prof_id:prof_id},function (data){
                $('#profesor_data').DataTable().ajax.reload();
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

function combo_rol(){
    $.post("/Maie/controller/rol.php?opc=combo", function (data) {
        $('#rol_id').html(data);
    });
}
function combo_escalfon(){
    $.post("/Maie/controller/escalafon.php?opc=combo", function (data) {
        $('#esc_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalProfesor').modal('show');
});

var ExcelToJSON = function() {
    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                ProfesorList = JSON.parse(json_object);

                console.log(ProfesorList)
                for (i = 0; i < ProfesorList.length; i++) {

                    var columns = Object.values(ProfesorList[i])

                    $.post("/Maie/controller/profesor.php?opc=guardar_desde_excel",{
                        prof_dni : columns[0],
                        prof_nom : columns[1],
                        prof_ape : columns[2],
                        prof_correo : columns[3],
                        prof_nivel : columns[4],
                        prof_sex : columns[5],
                        prof_telf :columns[6],
                        rol_id :columns[7],
                        esc_id :columns[8],
                        prof_est : columns[9]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#profesor_data').DataTable().ajax.reload();
                $('#modalProfesor').modal('hide');
            })
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);


init();