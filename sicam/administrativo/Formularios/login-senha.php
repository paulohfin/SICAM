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
        <title>Login e Senha</title>
        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css-formularios/estilo.css" >
    </head>

    <body> 
    <?php include(CABECALHO_TEMPLATE); ?>  

        <div class="container">
            
            <!--Barra de navegação da tabela com LOGIN E SENHA ativos-->  
			<div>
                <ul class="nav nav-tabs col col-md-11 col-lg-11">
                    <?php echo ($_GET['f2'] !== 'n') ? '<li><a href="index.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Dados Pessoais</a></li>' : '';
                    echo ($_GET['f1'] === '1' && $_GET['f2'] !== 'n') ? '<li><a href="escolaridade.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Escolaridade</a></li>' : '';
					
					echo ($_GET['f2'] === 'c') ? '<li><a href="contrato.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Dados do Contrato</a></li>' : '';
					
					echo ($_GET['f2'] !== 'n') ? '<li><a href="banco.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"">Informações Bancárias</a></li>' : '';
					echo ($_GET['f2'] !== 'n') ? '<li class="active"><a href="#">Login e Senha</a></li>' : '';
					?>
                </ul>
            </div>

            <!--Quebras de linhas para iniciar o aviso sobre a senha-->
            <br>
            <br>

            <?php if($_GET['f2'] === 'c') : ?>
                <h6  style="text-align: center; margin-top: 10px"> *Usar o login e senha abaixo para o primeiro acesso. Para alterar senha: "Perfil" >> "Alterar Senha".</h6>
            <?php endif; ?>
           
                <!--Login-->              
                <div class="row col-md-4 col-lg-4" id="login-senha">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span> 
                            <input class="form-control" placeholder="Usuário" name="loginname" type="text" autofocus value='<?php echo $_SESSION['nv']['login'] . "'"; if($_GET['f2'] != 'c') echo 'readonly'; ?> >
                        </div>
                    </div>

					<?php if($_GET['f2'] === 'c') : ?>
                        <!--Senha-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                </span>
                                <input class="form-control" placeholder="Senha" name="password" type="text"  value='<?php echo '12345678'; ?>' >
                            </div>
                        </div>
					<?php else : ?>
                        <!--Redefinir Senha-->
    					<form method='POST'>
    		                <div class="col-md-4 col-lg-4" id="bota-concluir-login">
    							<button class="btn btn-default" name='reiniciarsenha'>Redefinir Senha</button>
    						</div> 
    					</form>
					<?php endif; ?>
					
                    <div class="col-md-4 col-lg-4" id="bota-concluir-login" style="margin-left: 20px">
						<a href="../index.php"> <button class="btn btn-primary" >Concluir</button></a>
					</div> 

                </div>

        </div>  <!--Fim container-->

        <?php include(RODAPE_TEMPLATE); ?>  

    </body>
</html>
