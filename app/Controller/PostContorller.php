<?php

class PostController
{
    public function index($params)
    {
        // var_dump($params);
        try {
            // echo 'Home';
            #chamando Model Postagem
            $postagem = Postagem::selecionarPosPortId($params);
            // var_dump($postagem);

            //usando twig pra passar info p/ minha view sem misturar php e html juntos
            $loader = new  \Twig\Loader\FilesystemLoader("app/View/");
            $twig = new  \Twig\Environment($loader);
            $template = $twig->load('single.html'); //vai carregar a view

            //cria um array 
            $parametros = array();
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['data_criacao'] = $postagem->data_criacao;
            $parametros['autor'] = $postagem->autor;
            $parametros['comentarios'] = $postagem->comentarios;
            // var_dump($colecPostagens);

            //renderizar com os parametros
            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        
    }
}