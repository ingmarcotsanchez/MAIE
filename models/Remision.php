<?php
    class Remision extends Conectar{
        public function insert_remision($est_id, $mod_id, $jor_id,$cen_id,$prog_id,$seme_id,$tipaco_id,$asig_id,$nec_id,$prof_id,$remision_mens){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO remision (remision_id, est_id, mod_id, jor_id, cen_id, prog_id, seme_id, tipaco_id,asig_id, nec_id, prof_id, remision_mens, fech_crea estado) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,now(),1);";

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
            $sql = "UPDATE remision SET estado=0 WHERE remision_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$remision_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        /* public function remisiones(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM remision WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } */

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
                remision.estado
                
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
            $sql = "SELECT * FROM remision WHERE estado = 1 AND remision_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$remision_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

    }
?>