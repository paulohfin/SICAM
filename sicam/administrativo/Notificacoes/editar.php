<?php require_once 'funcoes.php'; ?>
<?php require_once DBAPI; ?>
<?php require_once VERIFICA_LOGADO; ?>
<?php
	/*
		Armazenando valores do estagiario no vetor assossiativo $_SESSION
	*/
	$_SESSION['nv'] = buscar_dados($_GET['id']);
	
	/*
		redirecionamento de página para edição de dados pessoais
	*/
	echo '<script>location.href="../Formularios/index.php?f1='. $_SESSION['nv']['fk_acesso'] . '&f2=n"</script>';
?>
