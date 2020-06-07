<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim(); // chamando nova aplicação do slim

$app->config('debug', true);

$app->get('/', function() {
    
	//echo "OK";

	$sql = new Hcode\DB\Sql(); // namespace (Hcode\DB)

	$results = $sql->select("SELECT * FROM tb_users");

	echo json_encode($results);

});

$app->run();

 ?>