<?php
	require_once '../../configuracao.php'; 
	require_once 'funcoes.php'; 
?>

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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Alterar Senha</title>
        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body> 

    <?php include(CABECALHO_TEMPLATE); ?>  
	<?php buscarsenhabd(); ?>

    <div style="margin-top: 40px"><!--Distância entre as divs --></div>


    <div class="container" style="margin-left: 35%">
        <!--Login-->              
        <div class="row col-md-4 col-lg-4">

            <div style="padding-left: 10%">
                <h5>*A senha deve conter números e letras</h5>
            </div>

            <div style="margin:20px"></div>

            <div class="form-group"  style="border: 1px solid #E0E0E0; padding: 10px; border-radius: 5px">
				<form method='POST'>
		            <label for="nome_user" >Nome de Usuário:</label>
		            <div class="input-group">
		                <span class="input-group-addon">
		                    <i class="glyphicon glyphicon-user"></i>
		                </span> 
		                <input class="form-control" id="nome_user" name="loginname" type="text" autofocus readonly value=<?php echo '"' . $dados['nome'] . '"';?>>
		            </div><br>

		            <label for="senha_antiga" >Senha Antiga:</label>
		            <div class="input-group">
		                <span class="input-group-addon">
		                    <i class="glyphicon glyphicon-remove-circle"></i>
		                </span> 
		                <input class="form-control" id="senha_antiga" name="oldsenha" type="text" autofocus >
		            </div><br>

		            <label for="nova_senha" >Nova Senha:</label>
		            <div class="input-group">
		                <span class="input-group-addon">
		                    <i class="glyphicon glyphicon-ok-circle"></i>
		                </span> 
		                <input class="form-control" id="nova_senha" name="nvsenha1" type="text" autofocus >
		            </div><br>

		            <label for="confirmar_nova_senha" >Confirmar Nova Senha:</label>
		            <div class="input-group">
		                <span class="input-group-addon">
		                    <i class="glyphicon glyphicon-ok-circle"></i>
		                </span> 
		                <input class="form-control" id="confirmar_nova_senha" name="nvsenha2" type="text" autofocus >
		            </div><br>

		        </div>

		        <div class="col-md-4 col-lg-4" style="margin-left: 100px">
					<a href="#"> <button class="btn btn-primary" name='update' type='submit'>Concluir</button></a>
				</div> 
			</form>
        </div>
    </div>  <!--Fim container-->

    <?php include(RODAPE_TEMPLATE); ?>  
    </body>
</html>
