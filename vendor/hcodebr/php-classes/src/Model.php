<?php

namespace Hcode; // ta no namespaces principal

class Model {

	private $values = []; // atributo privado $values

	public function __call($name, $args)//metodo magico pra saber toda vez que for chamado o metodo get ou set
	{

		$method = substr($name, 0, 3); // traga 3 posições a partir da posição 0 ( 0, 1, 2)
		$fieldName = substr($name, 3, strlen($name)); // vai da posição 3 ate o final da string nome

		//var_dump($method, $fieldName);
		//exit;
		switch ($method)
		{

			case "get":
				return $this->values[$fieldName];
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;
		}	
	}

	public function setData($data = array())
	{

		foreach ($data as $key => $value) {

			$this->{"set".$key}($value);

		}

	}

	public function getValues()
	{

		return $this->values;
	}

}

?>