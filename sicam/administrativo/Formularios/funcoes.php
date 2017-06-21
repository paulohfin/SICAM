<?php
	require_once('../../configuracao.php');
	require_once(DBAPI);
	require_once VERIFICA_LOGADO;
	require_once '../verifica.php';
	
	$supervisores = null;
	$lotacao = null;
	
	/*
		* função para retirar a mascara do CPF
		* recebe string
		* retorna string
	*/
	function editCPF($CPF){
		$mask = '';
				
		for($i = 0; $i < strlen($CPF); $i++)
			if($CPF[$i] === '.' || $CPF[$i] === '-' || $CPF[$i] === '(' || $CPF[$i] === ')' || $CPF[$i] === ' ')
				continue;
			else
				$mask .= $CPF[$i];
		return $mask;
	}
	/*
		* condicao para avançar em dados pessoais
		* insere nova pessoa se f2=c
		* atualiza dados pessoais se f2=e
	*/
	if(isset($_POST['continuar_dadospessoais'])){
		
		if($_GET['f2'] === 'c')
			$result = insert_pessoa(editCPF($_POST['cpf']), $_POST['nome'], $_POST['email'],
						editCPF($_POST['celular']), editCPF($_POST['tel1']), editCPF($_POST['cep']), 
						$_POST['endereco'], $_POST['bairro'], $_POST['cidade'],
						$_POST['uf'], $_POST['complemento']);
		else{
			$result = atualizar_pessoa(editCPF($_POST['cpf']), $_POST['nome'], $_POST['email'],
						editCPF($_POST['celular']), editCPF($_POST['tel1']), editCPF($_POST['cep']), 
						$_POST['endereco'], $_POST['bairro'], $_POST['cidade'],
						$_POST['uf'], $_POST['complemento']);
		}			
		if($result){
			$_SESSION['nv']['CPF'] = editCPF($_POST['cpf']);
			$_SESSION['nv']['nome'] = $_POST['nome'];
			$_SESSION['nv']['email'] = $_POST['email'];
			$_SESSION['nv']['telefone1'] = editCPF($_POST['celular']);
			$_SESSION['nv']['telefone2'] = editCPF($_POST['tel1']);
			$_SESSION['nv']['CEP'] = editCPF($_POST['cep']);
			$_SESSION['nv']['endereco'] = $_POST['endereco'];
			$_SESSION['nv']['setor'] = $_POST['bairro'];
			$_SESSION['nv']['cidade'] = $_POST['cidade'];
			$_SESSION['nv']['UF'] = $_POST['uf'];
			$_SESSION['nv']['complemento'] = $_POST['complemento'];
			
			insert_login($_SESSION['nv']['CPF'], $_GET['f1']);
			
			$result = buscar_login($_SESSION['nv']['CPF']);
			
			$_SESSION['nv']['login'] = $result['login'];
			
			/* redirecionando */
			if($_GET['f1'] === '1')
				echo '<script>location.href="escolaridade.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"</script>';
			else echo '<script>location.href="banco.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"</script>';
		}
		else echo '<script>alert("CPF já cadastrado");</script>';
	}
	/*
		* condicao para avançar em dados escolaridade
		* atualiza dados pessoais de estagiario
	*/
	if(isset($_POST['continuar_escolaridade'])){
		$result = atualizar_pessoa($_SESSION['nv']['CPF'],null,null,null,null,null,
		null,null,null,null,null,null,null,null,null,$_POST['curso'], $_POST['instituicao']);
					
		if($result){
			$_SESSION['nv']['curso'] = $_POST['curso'];
			$_SESSION['nv']['instituicao'] = $_POST['instituicao'];
			/* redirecionando */
			if($_GET['f2'] === 'c')
				echo '<script>location.href="contrato.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"</script>';
			else echo '<script>location.href="banco.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"</script>';
		}
	}
	/*
		* condicao para avançar em contrato
		* insere novo contrato se f2=c
		* atualiza novo contrato se f2=ce ou cn
	*/
	if(isset($_POST['continuar_contrato'])){
	
		insert_lotacao($_POST['lotacao']);
		
		$id_lotacao = buscar_id_lotacao($_POST['lotacao']);
		
		$dataInicio = str_replace("/", "-", $_POST['dataInicioEstagio']);
		$dataFim = str_replace("/", "-", $_POST['dataFimEstagio']);
		
		if($_GET['f2'] === 'c' || $_GET['f2'] === 'ce' || $_GET['f2'] === 'cn')
			$result = insert_contrato(date('Y-m-d', strtotime($dataInicio)), date('Y-m-d', strtotime($dataFim)),
					$_POST['optradio'], $_POST['valor'], $_POST['situacao-Contrato'], $_SESSION['nv']['CPF'],
					$id_lotacao, $_POST['supervisor']);
		else
			$result = update_contrato($_SESSION['nv']['id_contrato'], /*date('Y-m-d', strtotime($dataInicio))*/ null,
					date('Y-m-d', strtotime($dataFim)),	/*$_POST['optradio']*/ null, /*$_POST['valor']*/ null,
					$_POST['situacao-Contrato'], $_SESSION['nv']['CPF'], /*$id_lotacao*/ null, /*$_POST['supervisor']*/ null);	
		if($result){
			$_SESSION['nv']['lotacao_nome'] = $_POST['lotacao'];
			$_SESSION['nv']['data_inicio'] = date('Y-m-d', strtotime($dataInicio));
			$_SESSION['nv']['data_fim'] = date('Y-m-d', strtotime($dataFim));
			$_SESSION['nv']['situacao_contrato'] = $_POST['situacao-Contrato'];
			$_SESSION['nv']['convenio'] = $_POST['optradio'];
			$_SESSION['nv']['valor_estagio'] = $_POST['valor'];
			$_SESSION['nv']['Supervisor'] = $_POST['supervisor'];
			
			/* redirecionando */
			if($_GET['f1'] === '1' && $_GET['f2'] === 'c') echo '<script>location.href="banco.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"</script>';
			if($_GET['f2'] === 'e' || $_GET['f2'] === 'ce') echo '<script>location.href="../Consultas/visualizacao.php?id=' . $_SESSION['nv']['CPF'] . '"</script>';
			else{
				echo '<script>location.href="../Notificacoes/index.php"</script>';
			}
		}
		else echo '<script>alert("Verifique as datas");</script>';
	}	
	/*
		* condicao para avançar em dados bancarios
		* atualiza dados pessoais
	*/
	if(isset($_POST['continuar_banco'])){
		$result = atualizar_pessoa($_SESSION['nv']['CPF'], null, null, null, null, null,
		null, null, null, null, null, $_POST['banco'], $_POST['agencia'], $_POST['operacaoBancaria'], $_POST['conta'], null, null);
			
		if($result){
			$_SESSION['nv']['banco'] = $_POST['banco'];
			$_SESSION['nv']['agencia'] = $_POST['agencia'];
			$_SESSION['nv']['operacao'] = $_POST['operacaoBancaria'];
			$_SESSION['nv']['conta'] = $_POST['conta'];
			
			/* redirecionando */					
			echo ($_GET['f2'] === 'c') ? '<script>location.href="login-senha.php?f1=' . $_GET['f1'] . '&f2=' . $_GET['f2'] .'"</script>' : '<script>location.href="../"</script>';
		}
	}

	/*
		* condicao para restaurar senha
	*/
	if(isset($_POST['reiniciarsenha'])){
		$result = reiniciarsenha($_SESSION['nv']['CPF']);
		if($result)
		echo '<script>alert("Senha reiniciada: 12345678");</script>';
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
	/*
		buscar lotacao no BD
	*/
	function buscarlotacao(){
		global $lotacao;
		$lotacao = buscarlotacaoBD();
	}
	/*
		buscar lotacao no BD
	*/
	function buscarsupervisor(){
		global $supervisor;
	}
?>
