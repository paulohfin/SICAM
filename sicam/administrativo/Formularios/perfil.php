<?php
	require_once '../../configuracao.php';
	require_once DBAPI;
	require_once VERIFICA_LOGADO;
	
	$_SESSION['nv'] = find($_SESSION['CPF']);
	
	echo '<script>location.href="index.php?f1=1&f2=ep"</script>';
?>