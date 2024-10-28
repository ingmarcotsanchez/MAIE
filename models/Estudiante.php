<?php
    class Estudiante extends Conectar{
        public function insert_estudiante($est_dni, $est_tipo, $est_cedula,$est_nom,$est_ape,$est_fecnac,$est_correo,$est_sex,$est_telf,$est_estado){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO estudiante (est_id, est_dni, est_tipo, est_cedula, est_nom, est_ape, est_fecnac, est_correo, est_sex, est_telf, est_estado, est) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_dni);
            $sql->bindValue(2, $est_tipo);
            $sql->bindValue(3, $est_cedula);
            $sql->bindValue(4, $est_nom);
            $sql->bindValue(5, $est_ape);
            $sql->bindValue(6, $est_fecnac);
            $sql->bindValue(7, $est_correo);
            $sql->bindValue(8, $est_sex);
            $sql->bindValue(9, $est_telf);
            $sql->bindValue(10, $est_estado);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_estudiante($est_id,$est_dni, $est_tipo, $est_cedula,$est_nom,$est_ape,$est_fecnac,$est_correo,$est_sex,$est_telf,$est_estado){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE estudiante
                SET
                    est_dni = ?,
                    est_tipo = ?,
                    est_cedula = ?,
                    est_nom = ?,
                    est_ape = ?,
                    est_fecnac = ?,
                    est_correo = ?,
                    est_sex = ?,
                    est_telf = ?,
                    est_estado = ? 
                WHERE
                    est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_dni);
            $sql->bindValue(2, $est_tipo);
            $sql->bindValue(3, $est_cedula);
            $sql->bindValue(4, $est_nom);
            $sql->bindValue(5, $est_ape);
            $sql->bindValue(6, $est_fecnac);
            $sql->bindValue(7, $est_correo);
            $sql->bindValue(8, $est_sex);
            $sql->bindValue(9, $est_telf);
            $sql->bindValue(10, $est_estado);
            $sql->bindValue(11, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_estudiante($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE estudiante SET est=0 WHERE est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiante WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function estudiantes_id($est_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM estudiante WHERE est = 1 AND est_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$est_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        

        

        public function total_estudiantes_compromiso(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes_perdida(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM estudiante WHERE est_estado=2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>