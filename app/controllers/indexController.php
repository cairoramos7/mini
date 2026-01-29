<?php

class IndexController extends Controller{
	public function index(){
		// $dados['nome'] = $this->getParam('nome');
		// $dados['sobrenome'] = $this->getParam('sobrenome');

		$dados = $this->getParam();
		$this->view('home.index', $dados);
	}
}
