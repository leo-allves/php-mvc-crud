<?php

# Model incarregada de conectar no banco de dados

class Postagem
{
    public static function selecionaTodos()
    {
        $con = Connection::getConn();

        // var_dump($con);

        #Connectar no BD Postagem acessar registros
   
        $sql= "SELECT * FROM postagem ORDER BY id DESC"; //pegand. registo de forma decrecente
        $sql = $con->prepare($sql); // preparando e validando
        $sql->execute();

        #verificar se esta funcionando todos os registros
        
       $resultado = array();
        // print_r($sql->fetchAll());
        while ($row = $sql->fetchObject('Postagem')){
            $resultado[] = $row;
        }
        #verificando se $resultado tem algum registro
        if(!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }
        return $resultado;
        
    }
}
?>

