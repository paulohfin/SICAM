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
		echo $id;
		$estagiario = find($id);
		$contratos = find_contratos($id);
	}
	/*
		 buscar lista de estagiario no banco de dados
		* recebe uma string(CPF)
		* alimenta os vetores $estagiario e $contratos
	*/
	function buscar_dados($id = null){
		$dados = find($id);
		return $dados;
	}
	/*
		buscar dados de contrato de estagiario
	*/
	function buscar_dados_contrato($id = null){
		$dados = find_contrato($id);
		return $dados;
	}
	/*
		funcao buscar lista de estagiario
		recebe string
		armazena lista na variavel global $estagiarios
	*/
	function pesquisar_estagiarios($tipo, $txt){
		global $estagiarios;
		
		// pesquisa por cpf
		if($tipo == 'cpf')
			$estagiarios = buscar_cpf($txt);
		
		// pesquisa por nome
		if($tipo == 'nome')
			$estagiarios = buscar_nome($txt);
		
		//pesquisa por lotacao
		if($tipo == 'lotacao')
			$estagiarios = buscar_lotacao($txt);
		
		//pesquisa por status do contrato
		if($tipo == 'status')
			$estagiarios = buscar_status($txt);
	}

	/*
		funcao para exibir string em uma mascara
		recebe string, string(formato da mascara)
		retorna uma string
	*/
	function mask($val, $mask){
		$mascara = '';
		
		for($i = 0, $j = 0; $i < strlen($val); $i++, $j++)
			if($mask[$j] === $val[$i])
				$mascara .= $val[$i];
			elseif($mask[$j] === '#' && $val !== '.' && $val !== '-' && $val[$i] !== '(' && $val[$i] !== ')' && $val[$i] !== ' ')
				$mascara .= $val[$i];
			else{
				while($mask[$j] != '#' && $j < strlen($mask))
					$mascara .= $mask[$j++];
				while($val[$i] === '.' || $val[$i] === '-' || $val[$i] === '(' || $val[$i] === ')' || $val[$i] === ' ')
					$i++;
				$mascara .= $val[$i];
			}
		return $mascara;
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
