<?php

class Comentario
{
    #metodo para selecionar todos os comentarios pertencentes ao post especifico
    public static function selecionarComentarios($idPost)
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();


        #amarmazenar retorno em um array caso seja mais de 1 comentario
        $resultado = array();

        while($row = $sql->fetchObject('Comentario')){
            $resultado[] = $row;
        }
        return $resultado;

    }
}