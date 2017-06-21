<?php
	/*
		cria uma sessão ou resume a sessão atual usando a variavel $_SESSION
	*/
	session_start();
	
	/*
		verifica se foi efetuado o login
	*/
	if(!array_key_exists('tipo', $_SESSION) || !array_key_exists('CPF', $_SESSION))
		echo '<script>location.href="../index.php"</script>';
?>