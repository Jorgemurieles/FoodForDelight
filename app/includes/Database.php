<?php

// Nuestra clase de conexion

class DataBase
{
    private static $insta;
    private $dbh;
 
    private function __construct()
    {
        try {
            
            // Conexion a la base de datos de MySQL usando PDO
            $this->dbh = new PDO('mysql:host='.HOSTINGDB.';dbname='.DATABASENAME, USERDATABASE, PASSDATABASE);
            // Fijando la base de datos en UTF-8
            $this->dbh->exec("SET CHARACTER SET utf8");

        } catch (PDOException $e) {

            print "Error!: " . $e->getMessage();
            die();
        }
    }

    // Para la preparación del query que se usara
    public function prepare($sql)
    {
        return $this->dbh->prepare($sql);
    }
 
    // Instancia para que la clase de conexion
    public static function conexion()
    {
        if (!isset(self::$insta)) {
            $theClass = __CLASS__;
            self::$insta = new $theClass;
        }
        return self::$insta;
    }


    // Saber cual es el ultimo ID insertado en una tabla especifica
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }


    // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }


}