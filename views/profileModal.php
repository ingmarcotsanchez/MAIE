<div class="modal fade" id="modalcrearProfile" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="profile_form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="perfil_id" id="perfil_id">
                    <div class="row">
                        <div class="col-12">  
                            <div class="form-group">
                                <label for="perfil_nombre">Nombres</label>
                                <input type="text" class="form-control" name="perfil_nombre" id="perfil_nombre" placeholder="Ingrese un Nombre">
                            </div>
                            <div class="form-group">
                                <label for="perfil_detalle">Descripción</label>
                                <input type="text" class="form-control" name="perfil_detalle" id="perfil_detalle" placeholder="Ingrese una Descripción">
                            </div>
                            <div class="form-group">
                                <label for="cat_id">Categoria</label>
                                <select class="form-control select2" style="width:100%" name="cat_id" id="cat_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="perfil_telef">Celular</label>
                                <input type="text" class="form-control" name="perfil_telef" id="perfil_telef" placeholder="Ingrese un número de contacto">
                            </div>
                        </div>
                    </div> 
                </div> 
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>    
