<?php
/**
 * Created by PhpStorm.
 * User: CRMS7
 * Date: 13/12/2016
 * Time: 21:17
 */

class Produtos extends Controller{
	public function index(){
		$db = new Produtos_Model();

		// INSERT
		// $db->insert('posts', [
		// 	'titulo' => 'Titulo Aqui',
		// 	'resumo' => 'resumo aqui',
		// 	'conteudo' => 'conteudo aqui',
		// 	'comentarios' => '100'
		// ]);

		// READ
		// $db->read('posts', 'id=1');

		// UPDATE
		// $db->update('posts', [
		// 	'titulo' => 'Novo Titulo',
		// 	'conteudo' => 'Novo Conteudo'
		// ], 'id=1');

		// DELETE
		// $db->delete('posts', 'id=1');
		//$this->view('produtosIndex');
	}

    public function novos(){
    	$this->view('produtosNovos');
    }
}
