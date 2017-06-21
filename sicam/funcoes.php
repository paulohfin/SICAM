
<?php
	require_once('configuracao.php');
	require_once(DBAPI);
	
	/* Logar sistema*/
	session_start();
	
	/* Redireciondo caso já esteja logado */
	if(array_key_exists('tipo', $_SESSION) && array_key_exists('CPF', $_SESSION))
		/* Redirecionando */
		if($_SESSION['lotacao_nome'] === 'Diretoria Administrativa')
			echo '<script>location.href="administrativo"</script>';
		else
			echo '<script>location.href="emdesenvolvimento"</script>';
	
	/* Logando no sistema */
	if(isset($_POST['acessar'])){
		
		/* Verificando se login e senha estao corretos */
		$result = logar($_POST['loginname'], $_POST['password']);
		
		/* Redireciondo caso afirmativo */
		if($result->num_rows == 1){
			$row = mysqli_fetch_assoc($result);
			
			/* Armazenando dados temporários do usuário */
			$_SESSION['tipo'] = $row['fk_acesso'];
			$_SESSION['CPF'] = $row['fk_CPF'];
			$_SESSION['lotacao_nome'] = $row['lotacao_nome'];
			
			
			/* atualizar banco */
			atualiza_banco();
			
			/* Redirecionando */
			if($row['lotacao_nome'] === 'Diretoria Administrativa')
				echo '<script>location.href="administrativo"</script>';
			else
				echo '<script>location.href="emdesenvolvimento"</script>';
		}
		else echo '<script>alert("login/senha incorretos");</script>';
	}
?>
