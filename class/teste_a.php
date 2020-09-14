<?php
	
	//require_once("notificacao.php");
	//require_once("seguir.php");
	//require_once("noticia.php");
	//require_once("cripitografia_geral.php");
	require_once("usuario_.php");


	$u = new usuario();
	$u->setslug('matheusrizza');
	var_dump($u->login());

	/*$n = new post();
	$n->setuser_id('1');
	$n->settipo('1');
	$n->settexto('teste');
	$n->setpost_id('5');

	//var_dump($n->adicionar());
	var_dump($n->lista());
	var_dump($n->dados());*/

	//$c = new cripitografia();
	//$c->setuser_id('3');
	//$c->setchave('91683832');
	//$c->setslug('matheus');
	//$c->setchaveupdate('91683832');
	//$c->setslugupdate('matheusborges');

	//var_dump($c->criar());
	//var_dump($c->remover());
	//var_dump($c->verificar());
	//var_dump($c->mudar());
	//var_dump($c->abrir());

	/*$as = new seguir();
	$as->setuser_id("1");
	$as->setseguidor_id("3");

	var_dump($as->contar());*/

	
	/*$ta = new notificacao();
	$ta->setuser_id("1");
	$ta->settipo("2");

	var_dump($ta->buscar_lista());

	$ta->setnotificacao_id("6");
	
	var_dump($ta->buscar_unica());

	$te = new notificacao();
	$te->setuser_id("1");
	$te->settipo("2");
	$te->settexto("3");

	//var_dump($te->enviar());
	
	//$ts = new notificacao();
	// $ts->setnotificacao_id("5");
	
	//var_dump($ts->remover());*/
?>