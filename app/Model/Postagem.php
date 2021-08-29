<?php

# Model incarregada de conectar no banco de dados

class Postagem
{
    public static function selecionaTodos()
    {
        $con = Connection::getConn();
        // var_dump($con);

        #Connectar no BD Postagem acessar registros
        $sql= "SELECT * FROM postagem ORDER BY id DESC"; //
        $sql = $con->prepare($sql); // preparando e validando
        $sql->execute();

       #verificar se esta funcionando todos os registros
       $resultado = array();
        // echo '<pre>'; var_dump($sql->fetchAll()); exit;
        //var_dump($sql->fetchAll());
        
        while ($row = $sql->fetchObject('Postagem')){
            $resultado[] = $row;
        }
        // echo '<pre>'; print_r($resultado); exit;
        #verificando se $resultado tem algum registro
        if(!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }
        return $resultado;
        
    }

    # Metodo estatico para PostController.php só quando clico uma postagem
    public static function selecionarPosPortId($idPost)
    {
        $con = Connection::getConn(); //tipo PDO

        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql); //preparando
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT); //pegando e substituindo :id
        $sql->execute();

        #verificando se achou pegue o resultado e insira na class Postagem
        $resultado = $sql->fetchObject('Postagem');

        if(!$resultado){
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }else{
            //se existir a gente cria um array armazenando os comentários
            $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
        }
        return $resultado;

    }

}
?>

