<?php
    class Programas extends Conectar{

        /* TODO: Obtener registros por id de categoria */
        public function get_programas($cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM programas WHERE cen_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_programas2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM programas";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Obtener todos los registros sin filtro */
        public function get_programas_all(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            programas.prog_id,
            programas.codigo,
            programas.descripcion,
            programas.cen_id,
            centros.cen_nombre
            FROM programas INNER JOIN
            centros on programas.cen_id = centros.cen_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert */
        public function insert_programas($codigo,$descripcion,$cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO programas (prog_id,codigo,descripcion,cen_id) VALUES (NULL,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $descripcion);
            $sql->bindValue(3, $cen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update */
        public function update_programas($prog_id,$codigo,$descripcion,$cen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE programas set
                codigo = ?,
                descripcion = ?,
                cen_id = ?
                WHERE
                prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $descripcion);
            $sql->bindValue(3, $cen_id);
            $sql->bindValue(4, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete */
        public function delete_programas($prog_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM programas
                WHERE 
                prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_programas_x_id($prog_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM programas WHERE prog_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $prog_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>