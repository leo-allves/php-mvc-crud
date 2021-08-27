<?php

class HomeController
{
    public function index()
    {
        try {
            // echo 'Home';
            #chamando Model Postagem
            $colecPostagens = Postagem::selecionaTodos();


            //usando twig pra passar info p/ minha view sem misturar php e html juntos
            $loader = new  \Twig\Loader\FilesystemLoader("app/View/");
            $twig = new  \Twig\Environment($loader);
            $template = $twig->load('home.html'); //vai carregar a view

            //cria um array 
            $parametros = array();
            $parametros['postagens'] = $colecPostagens;
            // var_dump($colecPostagens);

            //renderizar com os parametros
            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        
    }
}