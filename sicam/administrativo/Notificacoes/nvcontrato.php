<?php
	require_once 'funcoes.php';
	require_once DBAPI;
	require_once VERIFICA_LOGADO;

	/*
		Armazenando valores do estagiario no vetor assossiativo $_SESSION
	*/
	$result = verificar_contratos($_GET['cpf']);
	
	/*
		redirecionamento de pagina para edição de dados pessoais
	*/
	if(!$result){
		unset($_SESSION['nv']);
		$_SESSION['nv']['CPF'] = $_GET['cpf'];
		echo '<script>location.href="../Formularios/contrato.php?f1=1&f2=cn"</script>';
	}
	else{
		echo '<script>alert("Estagiario com cadastro ativo");</script>';
		echo '<script>location.href="index.php"</script>';
	}
?>
