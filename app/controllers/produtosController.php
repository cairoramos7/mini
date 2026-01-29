<?php
/**
 * Created by PhpStorm.
 * User: CRMS7
 * Date: 13/12/2016
 * Time: 21:17
 */

class ProdutosController extends Controller{
	public function index(){
		$db = new ProdutosModel();

		// INSERT
		// $db->insert([
		// 	'titulo' => 'Titulo Aqui',
		// 	'resumo' => 'resumo aqui',
		// 	'conteudo' => 'conteudo aqui',
		// 	'comentarios' => '100'
		// ]);

		// READ
		// $db->read(['id' => 1]);

		// UPDATE
		// $db->update([
		// 	'titulo' => 'Novo Titulo',
		// 	'conteudo' => 'Novo Conteudo'
		// ], ['id' => 1]);

		// DELETE
		// $db->delete(['id' => 1]);
		//$this->view('produtos.index');
	}

    public function create(){
    	$this->view('produtos.novos');
    }
}
