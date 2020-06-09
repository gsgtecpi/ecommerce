<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model { // classe model

	const SESSION = "User";

	public static function login($login, $password)
	{

		$sql = new Sql(); // classe sql

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0) //se não encontrou nada
		{
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}			

		$data = $results[0]; // na posição 0

		if (password_verify($password, $data["despassword"]) === true)
		{

			$user = new User();

			$user->setData($data);

			//var_dump($user);
			//exit;

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {
			throw new \Exception("Usuário inexistente ou senha inválida");
		}

	}

	public static function verifyLogin($inadmin = true) // testa se é um usuario da administração
	{

		if (
			!isset($_SESSION[User::SESSION]) // se não for definida
			|| // ou
			!$_SESSION[User::SESSION] // se for falsa
			|| // ou
			!(int)$_SESSION[User::SESSION]["iduser"] > 0 // se não for maior que 0
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin // se for diferente de inadmin
		) {

			header("Location: /admin/login"); // redireciona pra tela de login
			exit;
		}
	}

	public static function logout()
	{


		$_SESSION[User::SESSION] = NULL;

	}
}


?>