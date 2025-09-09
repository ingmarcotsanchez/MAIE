<?php
    session_start();

    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try {
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=maie","root","3sp1n0s4");
                return $conectar;
			} catch (Exception $e) {
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();
			}
        }

        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        public static function ruta(){
            //QA
            return "http://localhost/MAIE/";
            //DESARROLLO
            //return "http://www.dominio.com/carpeta/";
        }

    }
?>
