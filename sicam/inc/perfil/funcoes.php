<?php
	require_once('../../configuracao.php');
	require_once(DBAPI);
	
	session_start();
	
	$dados = null;
	
	function buscarsenhabd(){
		global $dados;
		$dados = buscarsenha($_SESSION['CPF']);
	}
	if(isset($_POST['update']))
		if($_POST['nvsenha1'] === $_POST['nvsenha2']){
			$result = updatesenha($_SESSION['CPF'], $_POST['oldsenha'], $_POST['nvsenha1']);
			
			if($result)
				echo '<script>location.href="../../"</script>';
			else echo '<script>alert("Senha incorreta");</script>';
		}
		else echo '<script>alert("ERRO senhas nao conferem");</script>';
?>
