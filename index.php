<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim; // name spaces
use \Hcode\Page; // name spaces
use \Hcode\PageAdmin; // name spaces
use \Hcode\Model\User; // name spaces

$app = new Slim(); // chamando nova aplicação do slim, slim serve pra carregar rotas

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page(); // namespace (Hcode\DB)

	$page->setTpl("index");

});

$app->get('/admin', function() {

	User::verifyLogin();
    
	$page = new PageAdmin(); // namespace (Hcode\DB)

	$page->setTpl("index");

});

$app->get('/admin/login', function() {//rota pro login

	$page = new PageAdmin([ // passando array
		"header"=>false, // desabilitando header e footer padrão
		"footer"=>false
	]);

	$page->setTpl("login");

});	

$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin"); // redireciona para nossa home page da administração
	exit; //parar execução

});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

$app->run(); // faz tudo isso rodar

 ?>