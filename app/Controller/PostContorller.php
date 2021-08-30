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
            $parametros['id'] = $postagem->id;
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

    public function addComent()
    {
        try {
            #se conseguir inserir
            #vai chmar a model responsavel por add os coment. no BD
            Comentario::inserir($_POST);

            header('Location: http://php-mvc-crud.test/?pagina=post&id='.$_POST['id']);

        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=post&id='.$_POST['id'].'"</script>';
        }
    } 
}