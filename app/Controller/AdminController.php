<?php

class AdminController
{
    public function index()
    {
 
        # Twig porta de netrada para trabalhar com as views
        $loader = new  \Twig\Loader\FilesystemLoader("app/View/");
        $twig = new  \Twig\Environment($loader);
        $template = $twig->load('admin.html'); //vai carregar a view

        $objPostagens = Postagem::selecionaTodos();

        //cria um array 
        $parametros = array();
        $parametros['postagens'] = $objPostagens;
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

    public function insert()//metodo da controller
    {
        //tratamento de forma simples caso fosse ao ar teria que fazer metodos de segurança
        //tratamento de strings e sql inject depois se possivel criar uma class para isso
        // var_dump($_POST);

        try
        {
            Postagem::insert($_POST); //metodo dentro da model são diferentes

            echo '<script>alert("Publicação inserida com sucesso!");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=admin&metodo=index";</script>';

        }catch(Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=admin&metodo=create";</script>';
        }
    }

    public function change($paramId)
    {
        $loader = new  \Twig\Loader\FilesystemLoader('app/View/');
        $twig = new  \Twig\Environment($loader);
        $template = $twig->load('update.html'); //vai carregar a view

        //ler o id na url
        $post = Postagem::selecionarPosPortId($paramId);


        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['autor'] = $post->autor;
        $parametros['titulo'] = $post->titulo;
        $parametros['conteudo'] = $post->conteudo;
             
             
        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function update()
    {
        // var_dump($_POST);
        //se der erro no metodo update na postagem
        try {
            Postagem::update($_POST);

            echo '<script>alert("Publicação alterada com sucesso!");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=admin&metodo=index";</script>';

        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
        }
        
    }

    public function delete($paramId)
    {
        #capturar caso der erro    
        try {
            Postagem::delete($paramId);

            echo '<script>alert("Publicação deletada com sucesso!");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=admin&metodo=index";</script>';

        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://php-mvc-crud.test/?pagina=admin&metodo=index"</script>';
        }
        // $id = $_GET['id']; -> não preciso pois passei no Core pego com $paramId
        
    }

    
}