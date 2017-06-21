<?php require_once '../../configuracao.php'; ?>
<?php require_once 'funcoes.php'; ?>
<?php require_once DBAPI; ?>
<?php require_once VERIFICA_LOGADO; ?>
<?php require_once VERIFICA_NVCPF; ?>

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
        <title>Dados Bancários</title>
        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css-formularios/estilo.css" >
    </head>

    <body> 
        <?php include(CABECALHO_TEMPLATE); ?>   

        <div class="container">
                    
            <!--Barra de navegação da tabela com DADOS BANCÁRIOS ativos-->  
             <div>
                <ul class="nav nav-tabs col col-md-11 col-lg-11">
                    <?php echo '<li><a href="index.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'" >Dados Pessoais</a></li>';

                    echo ($_GET['f1'] === '1') ? '<li><a href="escolaridade.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Escolaridade</a></li>' : '';
					
					echo ($_GET['f2'] === 'c' && $_GET['f1'] === '1') ? '<li><a href="contrato.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Dados do Contrato</a></li>' : '';
					
                    echo '<li class="active"><a href="#">Informações Bancárias</a></li>';
                    
                    echo ($_GET['f2'] !== 'n') ? '<li><a href="login-senha.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Login e Senha</a></li>' : '';?>
                </ul>
            </div>
			
            <!--Formulário de Informações Bancárias-->
            <form method="POST" class="row col col-md-12 col-lg-12 formulario"> 

                <div class="col col-md-12 col-lg-12">

					<div class="col-md-4 col-lg-4 form-group">
						<label for="banco" >Banco:</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-home"></i>
							</span> 
							<input type="text" class="form-control" id="banco" name="banco" required='required' 
								<?php
									if(array_key_exists('nv', $_SESSION) && array_key_exists('banco', $_SESSION['nv']))
										echo 'value="' . $_SESSION['nv']['banco'] . '"';
                            		echo ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3') ? " required='required'" : ' readonly';
								?>>
						</div>
					</div>  

					<div class="col-md-2 col-lg-2 form-group">
						<label for="agencia" >Agência:</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-th"></i>
							</span> 
							<input type="text" class="form-control" id="agencia" name="agencia" 
								<?php
									if(array_key_exists('nv', $_SESSION) && array_key_exists('agencia', $_SESSION['nv']))
										echo ' value="' . $_SESSION['nv']['agencia'] . '"';
                            		echo ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3') ? " required='required'" : ' readonly';
								?> >
						</div>
					</div> 

					<div class="col-md-2 col-lg-2 form-group">
						<label for="operacaoBancaria" >Operação:</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-list"></i>
							</span> 
							<input type="text" class="form-control" id="operacaoBancaria" name="operacaoBancaria" 
								<?php
									if(array_key_exists('nv', $_SESSION) && array_key_exists('operacao', $_SESSION['nv']))
										echo ' value="' . $_SESSION['nv']['operacao'] . '"';	
                            		echo ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3') ? " required='required'" : ' readonly';
                            	?> >
						</div>
					 </div>

					<div class="col-md-4 col-lg-4 form-group">
						<label for="conta" >Conta:</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-th"></i>
							</span> 
							<input type="text" class="form-control" id="conta" name="conta"
								<?php
									if(array_key_exists('nv', $_SESSION) && array_key_exists('conta', $_SESSION['nv']))
										echo ' value="' . $_SESSION['nv']['conta'] . '"';
                            		echo ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3') ? " required='required'" : ' readonly';
								?>>
						</div>
					</div>
				</div>
				
					<!--Botões-->
					<div class="col col-md-12 col-lg-12 botao">                 
						<a href=<?php 
                    		if($_GET['f2'] === 'c') echo '"../index.php"';
                    		if($_GET['f2'] === 'e') echo '"../Consultas/"';
                    		if($_GET['f2'] === 'n') echo '"../Notificacoes/"';
							if($_GET['f2'] === 'ep') echo '"../"';
                    	?> class="btn btn-default">Cancelar</a>
						<a href="#" style="text-decoration: none"> 
							<button type="submit" class="btn btn-primary" name="continuar_banco" onclick="verificarInputsIndex()">Continuar</button>
						</a>
					</div>
            </form>              
        </div>
		<!--Fim container-->
		
        <?php include(RODAPE_TEMPLATE); ?>


        <!--JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="js-formularios/mascaras.js"></script>  

    </body>
</html>
