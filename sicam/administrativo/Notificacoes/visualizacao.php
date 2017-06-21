<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<?php require_once '../../configuracao.php'; 
	require_once 'funcoes.php'; 
	require_once DBAPI; 
	visualizacao($_GET['id']);
?>

<?php include(CABECALHO_TEMPLATE); ?>
<!--Nome do estagiário no cabeçalho da página -->

<h1><span style="margin-left: 20px; font-size: 20px; "><?php echo $estagiario['nome']; ?></span></h1>

<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>


<!--Informações do banco -->

<dl class="dl-horizontal">
	<dt>CPF :</dt>
	<dd><?php echo mask($estagiario['CPF'], '###.###.###-##'); ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>E-mail :</dt>
	<dd><?php echo $estagiario['email']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Celular :</dt>
	<dd><?php echo mask($estagiario['telefone1'],'(###) ##### ####'); ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Telefone :</dt>
	<dd><?php echo mask($estagiario['telefone2'],'(###) #### ####'); ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>CEP :</dt>
	<dd><?php echo mask($estagiario['CEP'], '##.###-###'); ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Endereco :</dt>
	<dd><?php echo $estagiario['endereco']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Setor :</dt>
	<dd><?php echo $estagiario['setor']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Cidade :</dt>
	<dd><?php echo $estagiario['cidade']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>UF :</dt>
	<dd><?php echo $estagiario['UF']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Complemento :</dt>
	<dd><?php echo $estagiario['complemento']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Banco :</dt>
	<dd><?php echo $estagiario['banco']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Agência :</dt>
	<dd><?php echo $estagiario['agencia']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Operação :</dt>
	<dd><?php echo $estagiario['operacao']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Conta :</dt>
	<dd><?php echo $estagiario['conta']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Curso :</dt>
	<dd><?php echo $estagiario['curso']; ?></dd>
</dl>
<dl class="dl-horizontal">
	<dt>Instituição :</dt>
	<dd><?php echo $estagiario['instituicao']; ?></dd>
</dl>

<!--Tabela com 1 ou mais contratos -->

<div id="actions" class="row">
	<div class="col-md-12 col-lg-12" style="margin-left: 10px">
		<a style="margin-left: 60px " href=<?php echo 'editar.php?id=' . $estagiario['CPF']; ?> class="btn btn-primary" > Editar dados pessoais</a>
	</div>
</div>

<table class="table table-hover table-bordered table-responsive">

<h3 style="padding-left: 10px; margin-top: 100px;"> Contrato(s) do estagiário:</h3>

	<thead>
		<tr>
			<th> Lotação </th>
			<th> Status do Contrato </th>
			<th> Início do Contrato </th>
			<th> Fim do Contrato </th>	
			<th> Opção</th>				
		</tr>
	</thead>

	<tbody>
		<?php if ($contratos) : ?>
			<?php foreach ($contratos as $contrato) : ?>
				<tr>
					<td><?php echo $contrato['lotacao_nome']; ?></td>
					<td><?php echo situacaocontrato($contrato['situacao_contrato']); ?></td>
					<td><?php echo date("d/m/Y", strtotime($contrato['data_inicio'])); ?></td>
					<td><?php echo date("d/m/Y", strtotime($contrato['data_fim'])); ?></td>

						
					<td class='actions text-center'><?php

							echo "<a href='editarcontrato.php?id=" . $contrato['id_contrato'] . "&CPF=" . $_GET['id'] . "' class='btn btn-sm btn-default' data-toggle='tooltip' title='Visualizar informações' data-placement='left' style='font-size: 5px'><i class='material-icons'>info_outline</i></a>"; ?> </td>
				</tr>
			<?php endforeach; ?>		
		<?php else : ?>

			<tr>
				<td colspan="6">Nenhum registro encontrado.</td>
			</tr>

		<?php endif; ?>
	</tbody>

</table> <!--Fim tabela -->

<div id="actions" class="row">
	<div class="col-md-12 col-lg-12" style="margin-left: 10px">
		<a href="index.php" class="btn btn-default">Nova Consulta</a>
		<a style="margin-left: 10px " href=<?php echo 'nvcontrato.php?cpf=' . $estagiario['CPF']; ?> class="btn btn-primary" > Adicionar novo contrato</a>
	</div>
</div>

<?php include(RODAPE_TEMPLATE); ?>
