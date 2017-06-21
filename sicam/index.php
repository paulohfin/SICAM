<?php require_once 'configuracao.php'; ?>
<?php require_once 'funcoes.php'; ?>
<?php require_once DBAPI; ?>

<?php $db = open_database(); ?>

<!DOCTYPE html>

<!--Tela de login e senha  -->

<html>
	<head>
		<meta charset="UTF-8">
		<title>Login form</title>
		<script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

		<link href='http://fonts.googleapis.com/css?family=Raleway:300,200' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>

		<form method='POST'>
			<div id='entrada' class="form">
				<div class="forceColor"></div>
				<div class="topbar">
					<div class="spanColor"></div>
					<input class="input" id="loguin" placeholder="Login" name="loginname">
					<input class="input" type='password' id="password" placeholder="Senha" name="password">
				</div>
				<input type='submit' class="submit" id="submit" value='Entrar' name='acessar'>
			</div>
		</form>
		
		<article class="article">
		<h1>SICAM</h1>

		</article>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="js/index.js"></script>

	</body>

</html>
