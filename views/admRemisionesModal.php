<div class="modal fade" id="modalcrearAsignatura" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="asignatura_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="asig_id" id="asig_id">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="est_id">ID Estudiante</label>
                                <select class="form-control select2" style="width:100%" name="est_id" id="est_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_id">Estudiante</label>
                                <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese su nombre" disabled>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="est_id">Celular</label>
                                <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese su nombre" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mod_id">Modalidad</label>
                                <select class="form-control select2" style="width:100%" name="mod_id" id="mod_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        
                   
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jor_id">Jornada</label>
                                <select class="form-control select2" style="width:100%" name="jor_id" id="jor_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cen_id">Centro de Operaciones</label>
                                <select class="form-control select2" style="width:100%" name="cen_id" id="cen_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prog_id">Programa</label>
                                <select class="form-control select2" style="width:100%" name="prog_id" id="prog_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="seme_id">Semestre</label>
                                <select class="form-control select2" style="width:100%" name="seme_id" id="seme_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tipaco_id">Tipo de Acompañamiento</label>
                                <select class="form-control select2" style="width:100%" name="tipaco_id" id="tipaco_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="asig_id">Asignatura</label>
                                <select class="form-control select2" style="width:100%" name="asig_id" id="asig_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nec_id">Necesidades especiales</label>
                                <select class="form-control select2" style="width:100%" name="nec_id" id="nec_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_id">Profesor que reporta</label>
                                <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <label for="rem_mens">Breve descripción del Acompañamiento</label>
                            <textarea id="rem_mens"name="rem_mens">
                            
                            </textarea>
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
