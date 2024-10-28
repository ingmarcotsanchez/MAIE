<?php
    class Necesidades extends Conectar{
        public function insert_necesidades($nec_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO necesidades (nec_id,nec_nombre, est) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nec_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_necesidades($nec_id,$nec_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE necesidades
                SET
                    nec_nombre = ?
                WHERE
                    nec_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nec_nombre);
            $sql->bindValue(2, $nec_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_necesidades($nec_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "DELETE FROM necesidades WHERE nec_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nec_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function necesidades(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM necesidades";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function necesidades_id($nec_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM necesidades WHERE est = 1 AND nec_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nec_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoActivo($nec_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE necesidades SET est=1 WHERE nec_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nec_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($nec_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE necesidades SET est=0 WHERE nec_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nec_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>