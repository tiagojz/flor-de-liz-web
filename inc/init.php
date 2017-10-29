<?php

session_start();

require_once 'config.php';
require_once 'db.php';
require_once 'helpers.php';

foreach ( glob( PATH . '/constantes/*.php' ) as $filename)
	require_once $filename;

require_once PATH . '/colecao/Colecao.php';
require_once PATH . '/calcados/Calcado.php';
require_once PATH . '/clientes/Cliente.php';
require_once PATH . '/producao/Producao.php';
require_once PATH . '/estoque/Estoque.php';