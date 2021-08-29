<?php

class Core 
{   
    // function que recebe a url
    public function start($urlGet)
    {   
        if(isset($urlGet['metodo'])){
            $acao = $urlGet['metodo'];
        }else{
            $acao = 'index';
        }
        // var_dump($urlGet);
        # declarando que todas as paginas tera na url o param pagina=...
        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'].'Controller');
        }else{
            $controller = 'HomeController';
        }
        
    

        #Se o controller que esta tentando acessar não existe
        if (!class_exists($controller)) {
            $controller = 'ErroController';
        }
        // die(var_dump($urlGet));
        // verif. se existe param id na $urlGet
        if(isset($urlGet['id']) && $urlGet['id'] != null){
            $id = $urlGet['id'];
        }else{
            $id =null;
        }

        #chamando á pagina Homecontroller e o metodo
        call_user_func_array(array(new $controller, $acao), array('id'=>$id));

        #identificar qual página está acessando e se esta acessando uma existente
        // echo $controller;
    }
}