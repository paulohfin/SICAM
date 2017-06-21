<?php
	require_once 'funcoes.php';
	require_once DBAPI;
	require_once VERIFICA_LOGADO;

	/*
		Armazenando valores do estagiario no vetor assossiativo $_SESSION
	*/
	$_SESSION['nv'] = buscar_dados($_GET['id']);
	
	/*
		redirecionamento de pagina para edição de dados pessoais
	*/
	echo '<script>location.href="../Formularios/index.php?f1=1&f2=e"</script>';
?>
