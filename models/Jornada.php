<?php
    class Jornada extends Conectar{
        public function insert_jornada($jor_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO jornada (jor_id,jor_nombre, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $jor_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_jornada($jor_id,$jor_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE jornada
                SET
                    jor_nombre = ?
                WHERE
                    jor_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $jor_nombre);
            $sql->bindValue(2, $jor_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_jornada($jor_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM jornada WHERE jor_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$jor_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function jornada(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM jornada";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function jornada_id($jor_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM jornada WHERE est = 1 AND jor_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$jor_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoActivo($jor_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE jornada SET est=1 WHERE jor_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$jor_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($jor_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE jornada SET est=0 WHERE jor_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$jor_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>