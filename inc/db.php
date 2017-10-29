<?php

try {
	/**
	 * Conexão com o banco de dados.
	 */
	$DB = new PDO( sprintf( 'pgsql:host=%s;dbname=%s', DB_HOST, DB_NAME ), DB_USER, DB_PASS );
	$DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( PDOException $e ) {
	die( '<h2>Erro na conexao com o banco de dados</h2>' . $e->getMessage() );
}
