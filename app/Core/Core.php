<?php

class Core 
{   
    // function que recebe a url
    public function start($urlGet)
    {
        $acao = 'index';
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

        #chamando á pagina Homecontroller e o metodo
        call_user_func_array(array(new $controller, $acao), array());

        #identificar qual página está acessando e se esta acessando uma existente
        // echo $controller;
    }
}