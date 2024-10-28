<?php
    class Profesor extends Conectar{
        public function insert_profesor($prof_dni, $prof_nom,$prof_ape,$prof_correo,$prof_niv,$prof_sex,$prof_telf,$rol_id,$esc_id,$prof_est){

            $conectar = parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO profesor (prof_id,prof_dni,prof_nom,prof_ape,prof_correo,prof_niv,prof_sex,prof_telf,rol_id,esc_id,prof_est,fech_crea, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prof_dni);
            $sql->bindValue(2, $prof_nom);
            $sql->bindValue(3, $prof_ape);
            $sql->bindValue(4, $prof_correo);
            $sql->bindValue(5, $prof_niv);
            $sql->bindValue(6, $prof_sex);
            $sql->bindValue(7, $prof_telf);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $esc_id);
            $sql->bindValue(10, $prof_est);
            $sql->execute();
            $sql1="SELECT last_insert_id() as 'prof_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
            //return $resultado = $sql->fetchAll();
        }

        public function update_profesor($prof_id,$prof_dni, $prof_nom,$prof_ape,$prof_correo,$prof_niv,$prof_sex,$prof_telf,$rol_id,$esc_id,$prof_est){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE profesor
                SET
                    prof_dni = ?,
                    prof_nom = ?,
                    prof_ape = ?,
                    prof_correo = ?,
                    prof_niv = ?,
                    prof_sex = ?,
                    prof_telf = ?,
                    rol_id = ?,
                    esc_id = ?,
                    prof_est = ?
                WHERE
                    prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prof_dni);
            $sql->bindValue(2, $prof_nom);
            $sql->bindValue(3, $prof_ape);
            $sql->bindValue(4, $prof_correo);
            $sql->bindValue(5, $prof_niv);
            $sql->bindValue(6, $prof_sex);
            $sql->bindValue(7, $prof_telf);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $esc_id);
            $sql->bindValue(10, $prof_est);
            $sql->bindValue(19, $prof_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_profesor($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE profesor SET est=0 WHERE prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function profesores(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM profesor";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function profesores2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                profesor.prof_id,
                profesor.prof_dni,
                profesor.prof_nom,
                profesor.prof_ape,
                profesor.prof_correo,
                profesor.prof_niv,
                profesor.prof_sex,
                profesor.prof_telf,
                rol.rol_id,
                rol.rol_nombre,
                escalafon.esc_id,
                escalafon.esc_nombre,
                profesor.prof_est
                FROM profesor
                INNER JOIN rol on profesor.rol_id = rol.rol_id
                INNER JOIN escalafon on profesor.esc_id = escalafon.esc_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        

        public function profesores_id($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM profesor WHERE est = 1 AND prof_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        

        public function update_estadoActivo($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE profesor SET prof_est=1, est=1 WHERE prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($prof_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE profesor SET prof_est=0, est=0 WHERE prof_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$prof_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
       
    }
?>