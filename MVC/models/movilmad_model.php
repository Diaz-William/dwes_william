<?php
    echo "Inicio modelo"."<br>";

    // Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
    // con la Base de Datos

    //Creación de una clase para ejecutar la sentencia SQL
    class movilmad_model{
        private $db;
        private $movilmad;
    
        public function __construct(){
            $this->db=Conectar::conexion();
            $this->movilmad=array();
        }
        public function get_movilmad(){
            $consulta=$this->db->query("select * from film;");
            while($filas=$consulta->fetch_assoc()){
                $this->movilmad[]=$filas;
            }
            return $this->movilmad;
        }
    }
    echo "Fin modelo"."<br>";
?>