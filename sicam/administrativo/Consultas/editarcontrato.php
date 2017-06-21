<?php require_once 'funcoes.php'; ?>
<?php require_once DBAPI; ?>
<?php require_once VERIFICA_LOGADO; ?>
<?php
	/*
		Armazenando valores do estagiario no vetor assossiativo $_SESSION
	*/
	$_SESSION['nv'] = buscar_dados_contrato($_GET['id']);
	$_SESSION['nv']['CPF'] = $_GET['CPF'];
	
	/*
		redirecionamento de pagina para edição de dados pessoais
	*/
	echo '<script>location.href="../Formularios/contrato.php?f1=1&f2=e"</script>';
?>
