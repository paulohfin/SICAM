<?php
		
	/* Redireciondo caso já nao seja do administrativo */
	if(array_key_exists('lotacao_nome', $_SESSION) && ($_SESSION['lotacao_nome'] === 'Diretoria Administrativa' || $_GET['f2'] === 'ep'))
		echo '';
	else echo '<script>location.href="' . BASEURL . 'emdesenvolvimento/"</script>';
?>