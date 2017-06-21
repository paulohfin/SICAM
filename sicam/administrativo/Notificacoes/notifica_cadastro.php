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
		<?php listar_cadastro(); ?>

		<header>
			<h3>Estagiários com o cadastro pendente: </h3>
			
		</header>
		
		<form method='POST'>
			<!--Tabela -->
			<table class="table table-hover table-bordered table-responsive">

				<?php
					echo '<thead>
						<tr>
							<th> CPF </th>
							<th width="35%">Nome</th>
							<th> Lotação </th>
							<th> Início do Contrato</th>
							<th> Fim do Contrato</th>
							<th> Opções</th>
						</tr>
						</thead><tbody>';

					if ($estagiarios){
						foreach ($estagiarios as $estagiario){
							
							echo '<tr>
								<td>' . mask($estagiario['fk_CPF'], '###.###.###-##') . '</td>
								<td>' . $estagiario['nome'] . '</td>';
								if($estagiario['lotacao_nome'])
									echo '<td>' . $estagiario['lotacao_nome'] . '</td>
									<td>' . date("d/m/Y", strtotime($estagiario['data_inicio'])) . '</td>
									<td>' . date("d/m/Y", strtotime($estagiario['data_fim'])) . '</td>';
								else 
									echo '<td></td><td></td><td></td>';
								
								echo "<td class='actions text-center'>
									<a href='visualizacao.php?id=" . $estagiario['fk_CPF'] . "' class='btn btn-sm btn-default' data-toggle='tooltip' title='Visualizar informações' data-placement='left' style='font-size: 5px'><i class='material-icons'>info_outline</i></a>";
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
					<button type="submit" class="btn btn-primary" name='atualizar_cadastro'>Atualizar</button>
				</a>
			</div>
		</form>
		
		<!--Incluindo o rodapé, fazendo a chamada configurada em configuracao.php -->
		<?php include(RODAPE_TEMPLATE); ?>

		<script type="text/javascript" src="js-notificacoes/funcoes.js"></script>

	</body>
</html>
