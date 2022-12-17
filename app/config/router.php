<?php

$this->get('/', 'SiteController@index');
$this->get('/formulario', 'CurriculoController@criarCurriculo');
$this->post('/formulario-salvar', 'CurriculoController@salvarCurriculo');
$this->get('/envio-arquivo', 'CurriculoController@upload');
$this->post('/arquivo-salvar', 'CurriculoController@salvarUpload');
$this->get('/cadastro-concluido', 'CurriculoController@sucesso');
$this->get('/funciona', 'SiteController@funciona');
$this->get('/empresa', 'SiteController@empresa');
$this->get('/home', 'SiteController@home');
$this->get('/institucional', 'SiteController@institucional');

