<?php

	/*Estrutura presente em configuracao.php*/
	mysqli_report(MYSQLI_REPORT_STRICT);

	/*Função para abrir o banco de dados*/
	function open_database() {
		try {
			$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			mysqli_set_charset( $conn, 'utf8');
			return $conn;
		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/*Função para fechar o banco de dados*/
	function close_database($conn) {
		try {
			mysqli_close($conn);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	/**
	 *  Pesquisa um Registro pelo ID em uma Tabela
	 */
	function find($id = null ) {
	  
		$database = open_database();
		$encontrar = null;

		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = "SELECT * FROM pessoa inner join login on CPF = fk_CPF WHERE CPF = '" . $id . "'";
			
			$result = $database->query($sql);

			if ($result) {
				$encontrar = mysqli_fetch_array($result);
				
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;
	}
	/*
		* Função para logar no sistema
		* recebe os parametros (string, string)
		* retorna um booleando
	*/
	function logar($login, $senha){
		$database = open_database();
		try{
			$sql = 'SELECT l.login, l.fk_acesso, l.fk_CPF, l2.lotacao_nome FROM login AS l INNER JOIN lotacao AS l2 '
					. 'ON l.login = "' . $login . '" AND l.senha = "' . md5($senha) . '" AND l.fk_lotacao = l2.id_lotacao';
					
			$result = $database->query($sql);
		}
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;
	}
	/*
		* Função para inserir os dados pessoais no BD
		* recebe os parametros(string, string, string, string, string, string, string, string, string,
								string, string, string, string, string, string, string, string)
		* retorna booleano
	*/	
	function insert_pessoa($cpf = null, $nome = null, $email = null, $celular = null, $tel1 = null, $cep = null,
							$endereco = null, $bairro = null, $cidade = null, $uf = null, $complemento = null,
							$banco = null, $agencia = null, $operacao = null, $conta = null, $curso = null, $instituicao = null){
	
		$database = open_database();
		try{
			/*requisição*/
			$sql = 'INSERT INTO pessoa VALUES("' . $cpf. '","' . $nome. '","' . $email. '","' . $celular. '","'
				. $tel1. '", "' . $cep . '", "' . $endereco. '", "' . $bairro. '", "' . $cidade. '", "' . $uf
				. '", "' . $complemento . '", "' . $banco. '", "' . $agencia. '", "' . $operacao. '", "' 
				. $conta. '", "' . $curso . '", "' . $instituicao. '")';
				
			$result = $database->query($sql);
			insert_notifica_cadastro($database, $cpf, $nome);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;
	}
	/*
		* Função para atualizar os dados pessoais no BD
		* recebe os parametros(string, string, string, string, string, string, string, string, string,
								string, string, string, string, string, string, string, string)
		* retorna booleano
	*/
	function atualizar_pessoa($cpf, $nome = null, $email = null, $celular = null, $tel1 = null, $cep = null,
							$endereco = null, $bairro = null, $cidade = null, $uf = null, $complemento = null,
							$banco = null, $agencia = null, $operacao = null, $conta = null, $curso = null, $instituicao = null){
		$database = open_database();
		$sql = 'update pessoa set ';
		if($nome) $sql .= ' nome = "' . $nome . '"';
		if($email)
			if(!$nome) $sql .= ' email = "' . $email . '"';
			else $sql .= ', email = "' . $email . '"';
		if($celular)
			if(!$nome && !$email) $sql .= ' telefone1 = "' . $celular . '"';
			else $sql .= ', telefone1 = "' . $celular . '"';
		if($tel1)
			if(!$nome && !$email && !$celular) $sql .= ' telefone2 = "' . $tel1 . '"';
			else $sql .= ', telefone2 = "' . $tel1 . '"';
		if($cep)
			if(!$nome && !$email && !$celular && !$tel1) $sql .= ' CEP = "' . $cep . '"';
			else  $sql .= ', CEP = "' . $cep . '"';
		if($endereco)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep) $sql .= ' endereco = "' . $endereco . '"';
			else  $sql .= ', endereco = "' . $endereco . '"';
		if($bairro)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco) $sql .= ' setor = "' . $bairro . '"';
			else  $sql .= ', setor = "' . $bairro . '"';
		if($cidade)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro) $sql .= ' cidade = "' . $cidade . '"';
			else  $sql .= ', cidade = "' . $cidade . '"';
		if($uf)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade) $sql .= ' UF = "' . $uf . '"';
			else  $sql .= ', UF = "' . $uf . '"';
		if($complemento)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf) $sql .= ' complemento = "' . $complemento . '"';
			else  $sql .= ', complemento = "' . $complemento . '"';
		if($banco)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf && !$complemento) $sql .= ' banco = "' . $banco . '"';
			else  $sql .= ', banco = "' . $banco . '"';
		if($agencia)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf && !$complemento && !$banco && !$agencia) $sql .= ' agencia = "' . $agencia . '"';
			else  $sql .= ', agencia = "' . $agencia . '"';
		if($operacao)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf && !$complemento && !$banco && !$agencia) $sql .= ' operacao = "' . $operacao . '"';
			else  $sql .= ', operacao = "' . $operacao . '"';
		if($conta)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf && !$complemento && !$banco && !$agencia && !$operacao) $sql .= ' conta = "' . $conta . '"';
			else  $sql .= ', conta = "' . $conta . '"';
		if($curso)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf && !$complemento && !$banco && !$agencia && !$operacao && !$conta) $sql .= ' curso = "' . $curso . '"';
			else  $sql .= ', curso = "' . $curso . '"';
		if($instituicao)
			if(!$nome && !$email && !$celular && !$tel1 && !$cep && !$endereco && !$bairro && !$cidade && !$uf && !$complemento && !$banco && !$agencia && !$operacao && !$conta && !$curso) $sql .= ' instituicao = "' . $instituicao . '"';
			else  $sql .= ', instituicao = "' . $instituicao . '"';
		$sql .= ' where cpf = "' . $cpf . '"';
		try{
			$result = $database->query($sql);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;
	}
	/*
		* Função para inserir uma nova lotação no BD, caso não existaos dados pessoais no BD
		* recebe o parâmetro(string)
	*/
	function insert_lotacao($nome){
		$database = open_database();
		try{
			$sql = 'INSERT INTO lotacao(lotacao_nome, n_contratos) SELECT * FROM (SELECT '
				. '"' . $nome . '", 5) AS tmp WHERE NOT EXISTS ( SELECT lotacao_nome FROM '
				. 'lotacao WHERE lotacao_nome = "' . $nome. '")';
			
			$database->query($sql);
		}	
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
	}
	/*
		* Função para inserir um novo contrato no BD
		* recebe os parâmetros(date, date, string, string, string, string, int, string)
		* verifica se não há contrato ativo
		* insere contrato
		* retorna booleando
	*/
	function insert_contrato($dataInicio, $dataFim, $convenio, $valor, $situacao_contrato, $cpf, $id_lotacao, $supervisor){
		$database = open_database();
		try{
			/* requisicao para verificar se há contrato ativo do estagiario */
			$sql = 'select * from contrato where fk_CPF = ' . $cpf . ' and situacao_contrato < 6';
			
			$result = $database->query($sql);
			
			if($result->num_rows == 0){
				$sql = 'INSERT INTO contrato(data_inicio, data_fim, convenio, valor_estagio, situacao_contrato, fk_CPF, fk_lotacao, supervisor) select '
					. $dataInicio . '","' . $dataFim . '","' . $convenio
						. '","' . $valor . '","' . $situacao_contrato . '","' . $cpf
						. '",' . $id_lotacao . ',"' . $supervisor . '" WHERE "' . $dataInicio . '" < "' . $dataFim . '" and not exists'
						. '(select * from contrato where fk_CPF = ' . $cpf . ' and ("' . $dataInicio . '" BETWEEN data_inicio and data_fim or "' . $dataFim
						. '" BETWEEN data_inicio and data_fim))';
						
				$result = $database->query($sql);
				$sql = 'select id_contrato from contrato where fk_CPF = ' . $cpf . ' and data_inicio = "' . $dataInicio . '"';
				
				$id = $database->query($sql);
				$id = $id->fetch_array(MYSQLI_ASSOC);
				
				insert_lotacao_login($database, $cpf, $id_lotacao);
				
				atualiza_tabela_contrato($id['id_contrato'], $database);
			}
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;
	}
	/*
		* Função para inserir um novo login no BD
		* recebe os parâmetros(string, int)
	*/
	function insert_login($cpf, $func){
		$database = open_database();
		try{
			$sql = 'INSERT INTO login(senha, fk_acesso, fk_CPF) SELECT "' . md5(12345678)
				. '", ' . $func . ', "' . $cpf . '"';
					
			$database->query($sql);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
	}
	/*
		* Função usada para buscar o login/senha
		* recebe(string)
		* retorna null/map de string
	*/
	function buscar_login($cpf){		
		$database = open_database();
		try{
			$sql = 'SELECT * FROM login WHERE fk_CPF = "' . $cpf . '"';
			
			$result = $database->query($sql);
			
			$row = mysqli_fetch_array($result);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $row;
	}
	/*
		* Função para pesquisar CPF no BD
		* recebe o parâmetro(string)
		* retorna uma lista(string, date, date)
	*/
	function buscar_cpf($cpf){
		$database = open_database();
		$encontrar = null;

		try {
			$sql = "SELECT pessoa.CPF, pessoa.nome, contrato.data_inicio, contrato.data_fim "
				. "FROM pessoa "
				. "LEFT JOIN contrato ON pessoa.CPF = contrato.fk_CPF where pessoa.CPF LIKE '%". $cpf . "%'";

			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$encontrar = $result->fetch_all(MYSQLI_ASSOC);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;
	}
	/*
		* Função para pesquisar nome no BD
		* recebe o parâmetro(string)
		* retorna uma lista(string, date, date)
	*/
	function buscar_nome($nome){
		$database = open_database();
		$encontrar = null;

		try {
			$sql = "SELECT pessoa.CPF, pessoa.nome, contrato.data_inicio, contrato.data_fim "
				. "FROM pessoa "
				. "LEFT JOIN contrato ON pessoa.CPF = contrato.fk_CPF where pessoa.nome LIKE '%" . $nome . "%'";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$encontrar = $result->fetch_all(MYSQLI_ASSOC);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;
	}
	/*
		* Função para pesquisar os estagiarios de uma lotacao no BD
		* recebe o parâmetro(string)
		* retorna uma lista(string, date, date)
	*/
	function buscar_lotacao($lotacao){
		$database = open_database();
		$encontrar = null;

		try {
			$sql = "SELECT vi.CPF, vi.nome, l.lotacao_nome, vi.data_inicio, vi.data_fim "
				. "FROM lotacao as l "
				. "INNER JOIN (select p.CPF, p.nome, c.data_inicio, c.data_fim, c.fk_lotacao from pessoa as p INNER JOIN contrato as c on p.CPF = c.fk_CPF) as vi on vi.fk_lotacao = l.id_lotacao where l.lotacao_nome LIKE '%" . $lotacao . "%'";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$encontrar = $result->fetch_all(MYSQLI_ASSOC);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;
	}
	/*
		* Função para pesquisar estagiarios por status
		* recebe o parâmetro(string)
		* retorna uma lista(string, date, date)
	*/
	function buscar_status($status){
		$database = open_database();
		$encontrar = null;

		try {
			$sql = "SELECT pessoa.CPF, pessoa.nome, contrato.situacao_contrato, contrato.data_inicio, contrato.data_fim "
				. "FROM contrato "
				. "INNER JOIN pessoa on pessoa.CPF = contrato.fk_CPF where contrato.situacao_contrato LIKE '%" . $status . "%'";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$encontrar = $result->fetch_all(MYSQLI_ASSOC);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;
	}
	
	/*
		* Função para listar estagiarios de uma tabela
		* retorna uma lista(string, string, string, date, date, date)
	*/
	function listando($table) {
	  
		$database = open_database();
		$encontrar = null;

		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = "SELECT * FROM " . $table . " order by fk_CPF";

			$result = $database->query($sql);

			if ($result) {
				$encontrar = $result->fetch_all(MYSQLI_ASSOC);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;
	}
	/*
		* Função para atualizar tabela notificacao
		* recebe array(CPF) e string(nome da tabela)
	*/
	function notificando($vetCPF, $info, $table){
		$database = open_database();
		/*atualizando tabela de notificacao de rescisao*/
		try {
			for($i = 0; $i < count($vetCPF); $i++){
			
				$sql = "UPDATE " . $table . " SET STATUS = 1
						WHERE fk_CPF = '" . $vetCPF[$i] . "'";

				$result = $database->query($sql);
			}
			for($i = 0; $i < count($info); $i++){
			
				$sql = "UPDATE " . $table . " SET comentario = '" . $info[$i]. "'
						WHERE fk_CPF IN(
							SELECT fk_CPF FROM(
								SELECT fk_CPF FROM " . $table . "  order by fk_CPF LIMIT " . $i . ", 1) as tmp);";
				
				$result = $database->query($sql);
				
				$sql = "UPDATE contrato SET comentario = '" . $info[$i]. "'
						WHERE id_contrato IN(
							SELECT fk_contrato FROM(
								SELECT fk_contrato FROM " . $table . "  order by fk_CPF LIMIT " . $i . ", 1) as tmp);";
				
				$result = $database->query($sql);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}	

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);			
	}
	/*
		* função para listar todos os contratos de um CPF
		* recebe string(CPF)
		* retorna um vetor de contratos
	*/
	function find_contratos($CPF){
	  
		$database = open_database();
		$encontrar = null;
		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = "SELECT c.id_contrato, l.lotacao_nome, c.situacao_contrato, c.data_inicio, c.data_fim "
				. "FROM contrato AS c inner join lotacao AS l ON l.id_lotacao = c.fk_lotacao WHERE fk_CPF = '" . $CPF . "'";

			$result = $database->query($sql);

			if ($result) {
				$encontrar = $result->fetch_all(MYSQLI_ASSOC);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;	
	}
	/*
		* função para listar dados de um contrato
		* recebe string(id do contrato)
		* retorna um vetor com os dados do contrato
	*/
	function find_contrato($id){
	  
		$database = open_database();
		$encontrar = null;
		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = "SELECT c.id_contrato, c.data_inicio, c.data_fim, c.convenio, c.valor_estagio, "
				. " c.situacao_contrato, c.supervisor, l.lotacao_nome FROM contrato as c inner join "
				. "lotacao as l on c.fk_lotacao = l.id_lotacao WHERE c.id_contrato = " . $id;

			$result = $database->query($sql);

			if ($result) {
				$encontrar = mysqli_fetch_array($result);
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;	
	}
	/*
		* Função para atualizar um contrato no BD
		* recebe os parâmetros(int, date, string,int, string)
		* atualiza contrato
		* retorna booleando
	*/	
	function update_contrato($id, $dataInicio = null, $dataFim = null, $convenio = null, $valor = null, $situacao_contrato = null, $cpf, $id_lotacao = null, $supervisor = null){
		$database = open_database();
		try{
			/* requisição de atualização */
			$sql = 'update contrato set ';
			if($dataInicio) $sql .= 'data_inicio = "' . $dataInicio . '"';
			if($dataFim)
				if($dataInicio) $sql .= ', data_fim = "' . $dataFim . '"';
				else $sql .= 'data_fim = "' . $dataFim . '"';
			if($convenio) 
				if($dataInicio || $dataFim) $sql .= ', convenio = "' . $convenio . '"';
				else $sql .= 'convenio = "' . $convenio . '"';
			if($valor)
				if($dataInicio || $dataFim || $convenio) $sql .= ', valor_estagio = "' . $valor . '"';
				else $sql .= 'valor_estagio = "' . $valor . '"';
			if($situacao_contrato)
				if($dataInicio || $dataFim || $convenio || $valor) $sql .= ', situacao_contrato = "' . $situacao_contrato . '"';
				else $sql .= 'situacao_contrato = "' . $situacao_contrato . '"';
			if($id_lotacao)
				if($dataInicio || $dataFim || $convenio || $valor || $situacao_contrato) $sql .= ', fk_lotacao = "' . $id_lotacao . '"';
				else $sql .= 'fk_lotacao = "' . $id_lotacao . '"';
			if($supervisor)
				if($dataInicio || $dataFim || $convenio || $valor || $situacao_contrato || $id_lotacao) $sql .= ', supervisor = "' . $supervisor . '"';
				else $sql .= 'supervisor = "' . $supervisor . '"';
			
			$sql .= ' where id_contrato = ' . $id;
			
			$result = $database->query($sql);
			
			insert_lotacao_login($database, $cpf, $id_lotacao);
				
			atualiza_tabela_contrato($id, $database);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;
	}
	/*
		* Função para atualizar tabelas de notifica_ferias e notifica_rescisao
		* insere e deleta linhas na tabela de rescisao
		* insere e deleta linhas na tabela de ferias
		* atualiza a data da ultima atualizacao
	*/
	function atualiza_banco(){
		$database = open_database();
		try{
			/* requisição de atualização */
			$sql = 'SELECT * FROM `atualizacao` where NOW() > DATE_ADD(atualizacao,INTERVAL 1 DAY)';
			
			$result = $database->query($sql);
			if($result->num_rows == 1){
				/* atualiza notifica_rescisao */
				$sql = "INSERT INTO notifica_rescisao(fk_CPF, nome, data_inicio, data_fim, lotacao_nome, status, fk_contrato, comentario)
					SELECT p.CPF, p.nome, vi.data_inicio, vi.data_fim, vi.lotacao_nome, 0, vi.id_contrato, vi.comentario 
					FROM pessoa AS p
					INNER JOIN(
						SELECT c.fk_CPF, c.data_inicio, c.data_fim, l.lotacao_nome, c.id_contrato, c.comentario FROM contrato AS c
						INNER JOIN lotacao AS l on c.fk_lotacao = l.id_lotacao
						WHERE NOW() BETWEEN DATE_SUB(c.data_fim, INTERVAL 15 DAY) AND c.data_fim) AS vi
						ON vi.fk_CPF = p.CPF
						WHERE NOT EXISTS (
							SELECT * FROM notifica_rescisao AS tmp
							WHERE p.CPF = tmp.fk_CPF
						);";
				$result = $database->query($sql);
				$sql = "DELETE FROM notifica_rescisao
					WHERE NOW() > data_fim;";
				$result = $database->query($sql);
				
				/* atualiza notifica_ferias */
				$sql = "INSERT INTO notifica_ferias(fk_CPF, nome, data_inicio, data_fim, inicio_ferias, lotacao_nome, status, fk_contrato, comentario)
					SELECT p.CPF, p.nome, vi.data_inicio, vi.data_fim, vi.inicio_ferias, vi.lotacao_nome, FALSE, vi.id_contrato, vi.comentario
					FROM pessoa AS p
					INNER JOIN(
						SELECT c.fk_CPF, c.data_inicio, c.data_fim,
							DATE_SUB(c.data_fim, INTERVAL 30 * ( TIMESTAMPDIFF(DAY, c.data_inicio, c.data_fim) % 365 ) / 365 DAY) AS inicio_ferias, l.lotacao_nome, c.id_contrato, c.comentario
							FROM contrato AS c INNER JOIN lotacao AS l on c.fk_lotacao = l.id_lotacao WHERE NOW() BETWEEN DATE_SUB(c.data_fim, INTERVAL 30 *( TIMESTAMPDIFF(DAY, c.data_inicio, c.data_fim) % 365 ) / 365 +15 DAY) AND c.data_fim) AS vi
						ON vi.fk_CPF = p.CPF
						WHERE NOT EXISTS (
							SELECT * FROM notifica_ferias AS tmp
							WHERE p.CPF = tmp.fk_CPF
						);";
				$result = $database->query($sql);
				$sql = "DELETE FROM notifica_ferias
					WHERE NOW() > data_fim;";					
				$result = $database->query($sql);
						
				/* atualiza data de atualizacao do banco */
				$sql = 'UPDATE atualizacao SET atualizacao = NOW()';
				$result = $database->query($sql);
			}
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
	}
	/*
		* funcao para atualizar tabela de login, adicionando chave estrangeira de lotacao
		* recebe connection, string(CPF), int(ID lotacao)
	*/
	function insert_lotacao_login($database, $CPF, $id){
		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = 'update login set fk_lotacao=' . $id . ' WHERE fk_CPF = ' . $CPF;
			$database->query($sql);
				
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
	}
	/*
		* funcao para retirar pessoa de notifica_cadastro
		* recebe connection com database e string(CPF)
	*/
	function atualiza_tabela_contrato($id, $database){
		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = 'INSERT into notifica_cadastro select * from(
					select p.CPF, vi.id_contrato, p.nome, vi.data_inicio, vi.data_fim, vi.lotacao_nome, vi.comentario from pessoa as p inner join(
						select c.fk_CPF, c.id_contrato, c.data_inicio, c.data_fim, l.lotacao_nome, c.comentario from contrato as c inner join lotacao as l 
						on c.fk_lotacao = l.id_lotacao 
						where c.id_contrato = ' . $id . ')
					as vi on vi.fk_CPF = p.CPF) as tmp where not exists(select * from notifica_cadastro where fk_contrato = ' . $id . ');';
			$database->query($sql);
			
			$sql = 'UPDATE notifica_cadastro as n, contrato as c, lotacao as l SET n.fk_contrato = ' . $id . ', n.data_inicio = c.data_inicio, n.data_fim = c.data_fim, n.lotacao_nome = l.lotacao_nome, n.comentario = c.comentario where n.fk_CPF = c.fk_CPF and c.id_contrato = ' . $id . ' and l.id_lotacao = c.fk_lotacao and exists(select * from notifica_cadastro where fk_contrato = ' . $id . ')';
			
			$result = $database->query($sql);
			
			$sql = "DELETE FROM notifica_cadastro WHERE fk_contrato = '" . $id . "' AND NOT EXISTS(SELECT * from pessoa inner join contrato on CPF = fk_CPF WHERE id_contrato = '" . $id . "' and (CEP is null OR endereco is null OR setor is null OR cidade is null OR UF is null OR complemento is null OR banco is null OR agencia is null OR operacao is null OR conta is null and situacao_contrato > 3))";

			$result = $database->query($sql);
				
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
	}
	/*
		* função para buscar nome e senha
		* recebe string(id)
		* retorna um vetor com (string, string)
	*/
	function buscarsenha($id){
	  
		$database = open_database();
		$encontrar = null;
		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = "SELECT p.nome, l.senha from pessoa as p inner join login as l on p.CPF = l.fk_CPF and p.CPF = " . $id;

			$result = $database->query($sql);

			$encontrar = mysqli_fetch_array($result);
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;	
	}
	/*
		* função para atualizar senha
		* recebe string, string, string
		* retorna booleano
	*/
	function updatesenha($cpf, $oldsenha, $nvsenha){
	  
		$database = open_database();
		$encontrar = null;
		/*Buscando o id informado para a pesquisa no banco*/
		try {
			$sql = 'select * from login where fk_CPF = "' . $cpf . '" and senha = "' . md5($oldsenha) . '"';
			
			$result = $database->query($sql);
			
			if($result->num_rows > 0){
				$sql = "UPDATE login set senha='" . md5($nvsenha) . "' WHERE fk_CPF = " . $cpf;
				
				$result = $database->query($sql);
			}
			else{
				close_database($database);
				return 0;			
			}
		} 
		/*Mensagem caso o id pesquisado não foi encontrado*/
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}		

		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;	
	}
	/*
		* Função para verificar se há contrato ativo
	*/
	function verificar_contratos($cpf){	
		$database = open_database();
		try{
			/* requisicao para verificar se há contrato ativo do estagiario */
			$sql = 'select * from contrato where fk_CPF = ' . $cpf . ' and situacao_contrato < 6';
			
			$result = $database->query($sql);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	/*
		* Função para inserir nome na tabela notifica_cadastro
		* recebe connecção, string, string
	*/
	function insert_notifica_cadastro($database, $cpf, $nome){		
		try{
			/* requisicao para verificar se há contrato ativo do estagiario */
			$sql = 'insert into notifica_cadastro(fk_CPF, nome) values("' . $cpf . '", "' . $nome . '")';
			
			$result = $database->query($sql);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
	}
	/*
		* Função para reiniciar senha
		* recebe string
	*/
	function reiniciarsenha($cpf){
		$database = open_database();
		try{
			/* requisicao para verificar se há contrato ativo do estagiario */
			$sql = 'update login set senha = "' . md5('12345678') . '" where fk_CPF = ' . $cpf;
			
			$result = $database->query($sql);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $result;	
	}
	/*
		* Função para buscar os dados de uma lotacao
		* recebe o parâmetro(string)
		* retorna um int
	*/
	function buscarlotacaoBD(){
		$database = open_database();
		try{
			$sql = 'SELECT * FROM lotacao order by lotacao_nome';
			
			$result = $database->query($sql);
			
			$encontrar = $result->fetch_all(MYSQLI_ASSOC);
		}		
		catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
	  	}
		/*Em ambas as ocasiões, fechar o banco após a pesquisa*/
		close_database($database);
		return $encontrar;		
	}
?>
