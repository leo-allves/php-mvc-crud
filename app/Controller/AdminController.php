<?php

class AdminController
{
    public function index()
    {
 
        # Twig porta de netrada para trabalhar com as views
        $loader = new  \Twig\Loader\FilesystemLoader("app/View/");
        $twig = new  \Twig\Environment($loader);
        $template = $twig->load('admin.html'); //vai carregar a view

        //cria um array 
        $parametros = array();
        // ex: de como passar parametros na view
        // $parametros['titulo'] = $postagem->titulo;
        
        
        //renderizar com os parametros
        $conteudo = $template->render($parametros);
        echo $conteudo;

    }

    public function create()
    {
        # Twig porta de netrada para trabalhar com as views
        $loader = new  \Twig\Loader\FilesystemLoader("app/View/");
        $twig = new  \Twig\Environment($loader);
        $template = $twig->load('create.html'); //vai carregar a view

        $parametros = array();
             
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function insert()
    {
        var_dump($_POST);
    }
}