<?php
//importando core
require_once './app/Core/Core.php';
//import Connection
require_once './lib/Database/Connection.php';
//import controllers
require_once './app/Controller/HomeController.php';
require_once './app/Controller/ErroController.php';
require_once './app/Controller/PostContorller.php';
require_once './app/Controller/SobreController.php';
require_once './app/Controller/AdminController.php';
//importando Models
require_once './app/Model/Postagem.php';
require_once './app/Model/Comentario.php';

//import docs composer
require_once './vendor/autoload.php';

# VARIAVEL QUE VAI CARREGAR MEU TAMPLETE- ESTRUTURA HTML
$template = file_get_contents('app/Template/estrutura.html');


#AGORA DEVO PEGAR A {{area_dinamica}} E TROCAR PELA HOME POR UM MSG ERRO PELA SOBRE.....
// echo($template); // trabalhando com query strings

#pegando o retorno da função $core->start($_GET); que vai trazer o html no corpo dosite
ob_start();
    #Usando core->é cerebro que irá acessar o controllers
    $core = new Core; //criando objeto
    $core->start($_GET);//chamando a function start do arq. core

    $saida = ob_get_contents();
ob_end_clean();

#carregando o conteudo da váriavel template
$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);
echo $tplPronto;


