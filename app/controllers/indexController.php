<?php

class Index extends Controller{
	public function index_action(){
		// $dados['nome'] = $this->getParam('nome');
		// $dados['sobrenome'] = $this->getParam('sobrenome');

		$dados = $this->getParam();
		$this->view('Index', $dados);
	}
}
