<?php
    class Tipos extends Conectar{
        public function insert_tipoAcompanamiento($tipaco_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO tipoAcompanamiento (tipaco_id,tipaco_nombre, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipaco_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_tipoAcompanamiento($tipaco_id,$tipaco_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tipoAcompanamiento
                SET
                    tipaco_nombre = ?
                WHERE
                    tipaco_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tipaco_nombre);
            $sql->bindValue(2, $tipaco_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_tipoAcompanamiento($tipaco_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM tipoAcompanamiento WHERE tipaco_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipaco_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function tipoAcompanamiento(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tipoAcompanamiento";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function tipoAcompanamiento_id($tipaco_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tipoAcompanamiento WHERE est = 1 AND tipaco_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipaco_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoActivo($tipaco_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tipoAcompanamiento SET est=1 WHERE tipaco_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipaco_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($tipaco_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tipoAcompanamiento SET est=0 WHERE tipaco_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$tipaco_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>