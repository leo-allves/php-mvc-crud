<?php

# Modelo Singonton - só cria uma instância da class PDO 

abstract class Connection
{
    private static $conn; //vai armazenar minha instancia PDO

    public static function getConn()
    {
        if(self::$conn == null){

            self::$conn = new PDO('mysql: host=localhost; dbname=serie-criando-site;', 'root', '');
        }
        return self::$conn;
    }

}

    


?>