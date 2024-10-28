var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/saber/controller/usuario.php?opc=mostrar",{usu_id : usu_id}, function (data){
        data = JSON.parse(data);
        console.log(data);
        $('#nombre').val(data.nombre);
        $('#usuario').val(data.usuario);
        $('#passwd').val(data.passwd);
        $('#perfil').val(data.perfil);
    });
});

$(document).on("click","#btnactualizar", function(){
    $.post("/saber/controller/usuario.php?opc=editPerfil", { 
        usu_id : $('#usu_idx').val(),
        nombre : $('#nombre').val(),
        cedula : $('#cedula').val(),
        usuario : $('#usuario').val(),
        passwd : $('#passwd').val(),
        perfil : $('#perfil').val(),
    }, function (data) {
    });
    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })


});