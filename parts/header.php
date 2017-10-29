<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Fábrica de Calçados Flor de Liz</title>
	<link rel="stylesheet" href="<?= home_url( 'css/bootstrap.min.css' ); ?>">
	<link rel="stylesheet" href="<?= home_url( 'css/style.css' ); ?>">
	</head>
</head>
<body>
	<header id="header">
		<nav class="navbar navbar-expand navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand text-uppercase" href="<?= home_url(); ?>">
					<strong>Flor de Liz</strong> &nbsp; <small>Fábrica de Calçados</small>
				</a>

				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= home_url( 'calcados' ); ?>">Calçados</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= home_url( 'producao' ); ?>">Produção</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= home_url( 'clientes' ); ?>">Clientes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= home_url( 'pedidos' ); ?>">Pedidos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= home_url( 'entregas' ); ?>">Entregas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= home_url( 'estoque' ); ?>">Estoque</a>
					</li>
				</ul>
			</div><!-- .container -->
		</nav><!-- .navbar -->
	</header><!-- #header -->

	<main role="main" class="container">

	<?php show_msgs(); ?>