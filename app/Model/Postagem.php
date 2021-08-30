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

    #Metodo para o insert chamdo na AdminController
    public static function insert($dadosPosts)
    {
        //se os dados tiver vazio
        if (empty($dadosPosts['autor']) || empty($dadosPosts['titulo']) || empty($dadosPosts['conteudo'])) {
            throw new Exception("Preencha todos os campos!");

            return false;
        }

        $con = Connection::getConn();

        $sql = 'INSERT INTO postagem (autor, titulo, conteudo, data_criacao) VALUES (:aut, :tit, :cont, now())';
        $sql = $con->prepare($sql);
        $sql->bindValue(':aut', $dadosPosts['autor']);
        $sql->bindValue(':tit', $dadosPosts['titulo']);
        $sql->bindValue(':cont', $dadosPosts['conteudo']);
        $result = $sql->execute();

        #criando validação para saber se inseriu ou não
        if($result == false || $result == 0){
            throw new Exception("Falha ao inserir postagem!");

            return false;
        }
        return true;
    }

    public static function update($params)
    {
        $con = Connection::getConn();

        $sql = "UPDATE postagem SET autor = :aut, titulo = :tit, conteudo = :cont WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':aut', $params['autor']);
        $sql->bindValue(':tit', $params['titulo']);
        $sql->bindValue(':cont', $params['conteudo']);
        $sql->bindValue(':id', $params['id']);
        $resultado = $sql->execute();

        if($resultado == 0){

            throw new Exception("Falha ao alterar publicação!");

            return false;
        }
        return true;
    }

    public static function delete($id)
    {
        $con = Connection::getConn();

        $sql = "DELETE FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if($resultado == 0){

            throw new Exception("Falha ao deletar publicação!");

            return false;
        }
        return true;
    }
}
?>

