<?php

namespace Hcode;

use Rain\Tpl;

class Page {

	private $tpl; // classe privada para outras classe não ter acesso
	private $options = []; // array vazio
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($opts = array(), $tpl_dir = "/views/"){ // parametro $opt por padrão será um array

		$this->defaults["data"]["session"] = $_SESSION;

		$this->options = array_merge($this->defaults, $opts); // merge faz uma mesclagem ou união de arrays

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header"); // desenhar o template na tela, cabeçalho
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

		if ($this->options["footer"] === true) $this->tpl->draw("footer"); // rodape onde eu posso colocar o javascript e outras informações

	}
}

?>