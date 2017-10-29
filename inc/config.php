<?php

/**
 * URL do sistema.
 */
define( 'HOME_URL', 'http://fabrica.dev' );


/**
 * Caminho do sistema no disco.
 */
define( 'PATH', dirname( dirname( __FILE__ ) ) );


/**
 * Conexão com o banco de dados.
 */
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'fabrica' );
define( 'DB_USER', 'postgres' );
define( 'DB_PASS', '123123' );


/**
 * Configurações de debug
 */
error_reporting(E_ALL);
ini_set( 'display_errors', 'on' );