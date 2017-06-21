<?php require_once '../../configuracao.php'; ?>
<?php require_once 'funcoes.php'; ?>
<?php require_once DBAPI; ?>
<?php require_once VERIFICA_LOGADO; ?>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <!--Compatibilidade com versões mais antigas de navegadores-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="ttps://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

    </head>

	<body>	

		<?php include(CABECALHO_TEMPLATE); ?>
		<?php listar_rescisao(); ?>

		<header>
			<h3>Próximas datas de rescisões dos contratos: </h3>
			
		</header>
		
		<form method='POST'>
			<!--Tabela -->
			<table class="table table-hover table-bordered table-responsive">

				<?php
					echo '<thead>
						<tr>
							<th> CPF </th>
							<th width="30%">Nome</th>
							<th> Lotação </th>
							<th> Início do Contrato</th>
							<th> Fim do Contrato</th>	
							<th> Comentários</th>					
							<th> Status </th>
						</tr>
						</thead><tbody>';

					if ($estagiarios){
						foreach ($estagiarios as $estagiario){
							
							echo '<tr>
								<td>' . mask($estagiario['fk_CPF'], '###.###.###-##') . '</td>
								<td>' . $estagiario['nome'] . '</td>
								<td>' . $estagiario['lotacao_nome'] . '</td>
								<td>' . date("d/m/Y", strtotime($estagiario['data_inicio'])) . '</td>
								<td>' . date("d/m/Y", strtotime($estagiario['data_fim'])) . '</td>
								<td><input type="text" name="comentario[]" value="' . $estagiario['comentario'] . '"></td>';
							if($estagiario['status'] === '0')
								echo '<td><input type="checkbox" name="check[]" value=' . $estagiario['fk_CPF'] . '>';
							else
								echo '<td><i data-toggle="tooltip" data-placement="left" title="Estagiário notificado" class="material-icons icons-designe" style="color: green">done</i></td>';
						}
					}else
						echo '<tr>
								<td colspan="6">Nenhum registro encontrado.</td>
							</tr>'; 
				?>

				</tbody>

			</table> <!--Fim tabela -->

			<!--Botões-->
			<div class="col col-md-12 col-lg-12 botao">            
				<a href="index.php" class="btn btn-default">Voltar</a>
				<a href="#" style="text-decoration: none; padding-left: 10px">  
					<button type="submit" class="btn btn-primary" name='atualizar_rescisao'>Atualizar</button>
				</a>
			</div>
		</form>
		
		<!--Incluindo o rodapé, fazendo a chamada configurada em configuracao.php -->
		<?php include(RODAPE_TEMPLATE); ?>

		<script type="text/javascript" src="js-notificacoes/funcoes.js"></script>

	</body>
</html>
