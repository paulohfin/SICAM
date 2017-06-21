<?php
	require_once('../../configuracao.php');
	require_once(DBAPI);
	
	$estagiarios = null;
	$estagiario = null;
	$contratos = null;
	/*
		 buscar lista de estagiario no banco de dados
		* recebe uma string(CPF)
		* alimenta os vetores $estagiario e $contratos
	*/
	function visualizacao($id = null){
		global $estagiario;
		global $contratos;
		$estagiario = find($id);
		$contratos = find_contratos($id);
	}
	/*
		buscar dados de contrato de estagiario
	*/
	function buscar_dados_contrato($id = null){
		$dados = find_contrato($id);
		return $dados;
	}
	/*
		funcao para atualizar o vetor de $estagiaros
		retorna uma lista de ferias
	*/
	function listar_ferias() {
		global $estagiarios;
		$estagiarios = null;
		$estagiarios = listando('notifica_ferias');
	}
	/*
		Atualizar tabela notifica_ferias
	*/
	if(isset($_POST['atualizar_ferias'])){
		if(array_key_exists('check', $_POST))
			$check = $_POST['check'];
		else $check = null;
		notificando($check, $_POST['comentario'], 'notifica_ferias');
		
		echo '<script>location.href="notifica_ferias.php"</script>';
	}
	/*
		Atualizar tabela notifica_rescisao
	*/
	if(isset($_POST['atualizar_rescisao'])){
		if(array_key_exists('check', $_POST))
			$check = $_POST['check'];
		else $check = null;
		notificando($check, $_POST['comentario'], 'notifica_rescisao');
		
		echo '<script>location.href="notifica_rescisao.php"</script>';
	}
	/*
		funcao para atualizar o vetor de $estagiaros
		retorna uma lista de cadastros pendentes
	*/
	function listar_cadastro() {
		global $estagiarios;
		$estagiarios = null;
		$estagiarios = listando('notifica_cadastro');
	}
	/*
		funcao para atualizar o vetor de $estagiaros
		retorna uma lista de rescisoes
	*/
	function listar_rescisao() {
		global $estagiarios;
		$estagiarios = null;
		$estagiarios = listando('notifica_rescisao');
	}
	/*
		funcao para exibir string em uma mascara
		recebe string, string(formato da mascara)
		retorna uma string
	*/
	function mask($val, $mask){
		$mascara = '';
		
		for($i = 0, $j = 0; $i < strlen($val); $i++, $j++)
			if($j < strlen($mask) &&$mask[$j] === $val[$i])
				$mascara .= $val[$i];
			elseif($j < strlen($mask) && $mask[$j] === '#' && $val !== '.' && $val !== '-' && $val[$i] !== '(' && $val[$i] !== ')' && $val[$i] !== ' ')
				$mascara .= $val[$i];
			else{
				while($j < strlen($mask) && $mask[$j] != '#')
					$mascara .= $mask[$j++];
				while($val[$i] === '.' || $val[$i] === '-' || $val[$i] === '(' || $val[$i] === ')' || $val[$i] === ' ')
					$i++;
				$mascara .= $val[$i];
			}
		return $mascara;
	}
	
	/*
		buscar dados de estagiario pelo CPF
	*/
	function buscar_dados($id = null){
		$dados = find($id);
		return $dados;
	}
	
	function situacaocontrato($id = null){
		switch($id){
			case '1':
				return 'Checando CPF';
				break;
			case '2':
				return 'Contrato está no CIEE/IEL';
				break;
			case '3':
				return 'Contrato está com o estagiário';
				break;
			case '4':
				return 'Estagiário contratado';
				break;
			case '5':
				return 'Estagiário está de férias';
				break;
			case '6':
				return 'Contrato rescindido';
				break;
			default:
				return 'Escolha uma opção';
		}
	}
?>
