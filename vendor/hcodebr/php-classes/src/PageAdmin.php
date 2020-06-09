<?php

namespace Hcode;

class PageAdmin extends Page { // herda as heranças da Classe Page page.php

	public function __construct($opts = array(), $tpl_dir = "/views/admin/")
	{
		
		parent::__construct($opts, $tpl_dir); // chama metodo construtor da classe pai Page

	}
	
}


?>