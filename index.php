<?php 

require_once("vendor/autoload.php");

use \Slim\Slim; // name spaces
use \Hcode\Page; // name spaces

$app = new Slim(); // chamando nova aplicação do slim, slim serve pra carregar rotas

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page(); // namespace (Hcode\DB)

	$page->setTpl("index");

});

$app->run(); // faz tudo isso rodar

 ?>