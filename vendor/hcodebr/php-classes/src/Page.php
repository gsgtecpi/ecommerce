<?php

namespace Hcode;

use Rain\Tpl;

class Page {

	private $tpl; // classe privada para outras classe não ter acesso
	private $optiosn = []; // array vazio
	private $defaults = [
		"data"=>[]
	];

	public function __construct($opts = array()){ // parametro $opt por padrão será um array

		$this->options = array_merge($this->defaults, $opts); // merge faz uma mesclagem ou união de arrays

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header"); // desenhar o template na tela, cabeçalho
	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		$this->tpl->draw("footer"); // rodape onde eu posso colocar o javascript e outras informações

	}
}

?>