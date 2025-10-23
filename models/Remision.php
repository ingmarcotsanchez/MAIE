<?php
    class Remision extends Conectar{
        public function insert_remision($est_id, $mod_id, $jor_id,$cen_id,$prog_id,$seme_id,$tipaco_id,$asig_id,$nec_id,$prof_id,$remision_mens,$usu_id){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO remision (remision_id, est_id, mod_id, jor_id, cen_id, prog_id, seme_id, tipaco_id,asig_id, nec_id, prof_id, remision_mens, usu_id, fech_crea, estado) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,now(),'Abierto');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_id);
            $sql->bindValue(2, $mod_id);
            $sql->bindValue(3, $jor_id);
            $sql->bindValue(4, $cen_id);
            $sql->bindValue(5, $prog_id);
            $sql->bindValue(6, $seme_id);
            $sql->bindValue(7, $tipaco_id);
            $sql->bindValue(8, $asig_id);
            $sql->bindValue(9, $nec_id);
            $sql->bindValue(10, $prof_id);
            $sql->bindValue(11, $remision_mens);
            $sql->bindValue(12, $usu_id);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_remision($remision_id,$est_id, $mod_id, $jor_id,$cen_id,$prog_id,$seme_id,$tipaco_id,$asig_id,$nec_id,$prof_id,$remision_mens){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE remision
                SET
                    est_id = ?,
                    mod_id = ?,
                    jor_id = ?,
                    cen_id = ?,
                    prog_id = ?,
                    seme_id = ?,
                    tipaco_id = ?,
                    asig_id = ?,
                    nec_id = ?,
                    prof_id = ?,
                    remision_mens = ?
                WHERE
                    remision_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_id);
            $sql->bindValue(2, $mod_id);
            $sql->bindValue(3, $jor_id);
            $sql->bindValue(4, $cen_id);
            $sql->bindValue(5, $prog_id);
            $sql->bindValue(6, $seme_id);
            $sql->bindValue(7, $tipaco_id);
            $sql->bindValue(8, $asig_id);
            $sql->bindValue(9, $nec_id);
            $sql->bindValue(10, $prof_id);
            $sql->bindValue(11, $remision_mens);
            $sql->bindValue(12, $remision_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_remision($remision_id){
            $conectar = parent::Conexion();
            parent::set_names();
            //$sql = "UPDATE remision SET estado=0 WHERE remision_id = ?";
            $sql = "DELETE FROM remision WHERE remision_id=?";
            $sql2 = "INSERT INTO auditoria (aud_id, remision_id, fech_crea) values (NULL,?,now())";
            $sql=$conectar->prepare($sql);
            $sql2=$conectar->prepare($sql2);
            $sql->bindValue(1,$remision_id);
            $sql2->bindValue(1,$remision_id);
            $sql->execute();
            $sql2->execute();
            return $resultado = $sql->fetchAll();
        }

      

        public function remisiones(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                remision.remision_id,
                estudiante.est_id,
                estudiante.est_dni,
                estudiante.est_nom,
                estudiante.est_ape,
                estudiante.est_telf,
                modalidad.mod_id,
                modalidad.mod_nombre,
                jornada.jor_id,
                jornada.jor_nombre,
                centros.cen_id,
                centros.cen_nombre,
                programas.prog_id,
                programas.descripcion,
                semestres.seme_id,
                semestres.seme_nombre,
                tipoAcompanamiento.tipaco_id,
                tipoAcompanamiento.tipaco_nombre,
                asignaturas.asig_id,
                asignaturas.asig_nom,
                necesidades.nec_id,
                necesidades.nec_nombre,
                profesor.prof_id,
                profesor.prof_nom,
                profesor.prof_ape,
                remision.remision_mens,
                remision.fech_crea,
                remision.estado,
                remision.fech_cierre
                
                FROM remision
                INNER JOIN estudiante on remision.est_id = estudiante.est_id
                INNER JOIN modalidad on remision.mod_id = modalidad.mod_id
                INNER JOIN jornada on remision.jor_id = jornada.jor_id
                INNER JOIN centros on remision.cen_id = centros.cen_id
                INNER JOIN programas on remision.prog_id = programas.prog_id
                INNER JOIN semestres on remision.seme_id = semestres.seme_id
                INNER JOIN tipoAcompanamiento on remision.tipaco_id = tipoAcompanamiento.tipaco_id
                INNER JOIN asignaturas on remision.asig_id = asignaturas.asig_id
                INNER JOIN necesidades on remision.nec_id = necesidades.nec_id
                INNER JOIN profesor on remision.prof_id = profesor.prof_id
                
                
                
                
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function remisiones_id($remision_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM remision INNER JOIN profesor on remision.prof_id = profesor.prof_id WHERE remision.remision_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$remision_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function remisiones_idDetalles($remision_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "
                SELECT 
                    remision.remision_id,
                    remision.fech_crea,
                    remision.estado,
                    centros.cen_nombre,
                    modalidad.mod_nombre,
                    jornada.jor_nombre,
                    programas.descripcion,
                    semestres.seme_nombre,
                    asignaturas.asig_nom,
                    necesidades.nec_nombre,
                    profesor.prof_nom,
                    profesor.prof_ape,
                    tipoAcompanamiento.tipaco_nombre,
                    estudiante.est_nom,
                    estudiante.est_ape,
                    remision.remision_mens
                FROM remision 
                INNER JOIN estudiante on remision.est_id = estudiante.est_id
                INNER JOIN modalidad on remision.mod_id = modalidad.mod_id
                INNER JOIN jornada on remision.jor_id = jornada.jor_id
                INNER JOIN centros on remision.cen_id = centros.cen_id
                INNER JOIN programas on remision.prog_id = programas.prog_id
                INNER JOIN semestres on remision.seme_id = semestres.seme_id
                INNER JOIN tipoAcompanamiento on remision.tipaco_id = tipoAcompanamiento.tipaco_id
                INNER JOIN asignaturas on remision.asig_id = asignaturas.asig_id
                INNER JOIN necesidades on remision.nec_id = necesidades.nec_id
                INNER JOIN profesor on remision.prof_id = profesor.prof_id
                WHERE remision.remision_id=?
            ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$remision_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insert_ticketdetalle($remision_id,$usu_id,$seg_descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO seguimientos (seg_id,remision_id,usu_id,seg_descripcion,fech_crea,est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $remision_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $seg_descripcion);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        

        public function listar_ticketdetalle_x_ticket($remision_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                seguimientos.seg_id,
                seguimientos.seg_descripcion,
                seguimientos.fech_crea,
                usuario.usu_nom,
                usuario.usu_ape,
                usuario.usu_rol
                FROM seguimientos
                INNER JOIN usuario ON seguimientos.usu_id = usuario.usu_id
                WHERE 
                remision_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $remision_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($remision_id){
            $conectar= parent::conexion();
            parent::set_names();
            
            $sql="UPDATE remision
                    SET
                        estado = 'Cerrado',
                        fech_cierre = now()
                    WHERE
                        remision_id = ?";
                    
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $remision_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_cerrar($remision_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="call sp_i_ticketdetalle_01(?,?)";
            $sql="INSERT INTO seguimientos (seg_id,remision_id,usu_id,seg_descripcion,fech_crea,est) VALUES (NULL,?,?,'Ticket Cerrado',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $remision_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

    }
?>