<?php

class IndexController extends Controller{
	public function index_action(){
		// $dados['nome'] = $this->getParam('nome');
		// $dados['sobrenome'] = $this->getParam('sobrenome');

		$dados = $this->getParam();
		$this->view('Index', $dados);
	}
}
