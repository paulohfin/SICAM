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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
		<title>Dados Pessoais</title>

        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link rel="stylesheet" href="css-formularios/estilo.css" >       

        <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" /> 

    </head>

    <body> 

        <?php include(CABECALHO_TEMPLATE); ?> 

        <div class="container">          
            <!--Barra de navegação da tabela com DADOS PESSOAIS ativos--> 
						
            <div>
                <ul class="nav nav-tabs col col-md-11 col-lg-11">
                    <li class="active"><a href="#">Dados Pessoais</a></li>

                    <?php echo ($_GET['f1'] === '1') ? '<li><a href="escolaridade.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Escolaridade</a></li>' : '';
					?>
                    <?php
						echo ($_GET['f2'] === 'c' && $_GET['f1'] === '1') ? '<li><a href="contrato.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Dados do Contrato</a></li>' : '';
					
                    echo '<li><a href="banco.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] . '">Informações Bancárias</a></li>';                   
                    echo ($_GET['f2'] !== 'n') ? '<li><a href="login-senha.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Login e Senha</a></li>' : '';?>
                </ul>
            </div>

            <!--Formulário dos dados pessoais-->
            <form method="POST" class=" row col col-md-12 col-lg-12 formulario" name="formulario"> 
                <div class="col col-md-12 col-lg-12">  
                   
                    <div class="col-md-3 col-lg-3 form-group">
                        <label for="cpf" >CPF:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-certificate"></i>
                            </span> 
                            <input type="text" class="form-control " id="cpf" name="cpf" placeholder="ex.: 000.000.000-00"
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('CPF', $_SESSION['nv'])) 
                            			echo ' value="' . $_SESSION['nv']['CPF'] . '"';
                            		echo ($_GET['f2'] === 'c' && ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3')) ? " required='required'" : ' readonly';
                            	?>>
                        </div>
                    </div> 

                    <div class="col-md-9 col-lg-9 form-group">
                        <label for="nome" >Nome:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span> 
                            <input type="text" class="form-control" id="nome" name="nome"
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('nome', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['nome'] . '"';
                            		echo ($_GET['f2'] === 'c' && ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3')) ? "'' required='required'" : ' readonly';
                            	?>>
                        </div>
                    </div>

					<!--Linha 2 -->
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="email" >Email:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span> 
                            <input type="text" class="form-control" id="email" name="email" placeholder="ex.: exemplo@exemplo.com" 
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('email', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['email'] . '"';
                            	?>>
                        </div>
                    </div> 
                    <div class="col-md-3 col-lg-3 form-group">
                        <label for="celular" >Celular:</label>
                         <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-phone"></i>
                            </span> 
                            <input type="text" class="form-control" id="celular" name="celular" placeholder="ex.: (062) 9 xxxx-xxxx"  
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('telefone1', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['telefone1'] . '"';
                            	?>>
                        </div>
                     </div> 

                    <div class="col-md-3 col-lg-3 form-group">
                        <label for="tel1" >Telefone:</label>
                         <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-phone-alt"></i>
                            </span> 
                            <input type="text" class="form-control" id="tel1" name="tel1" placeholder="ex.: (062) xxxx-xxxx" 
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('telefone2', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['telefone2'] . '"';
                            	?>>
                        </div>
                     </div>

					<!--Linha 3 -->
                    <div class="col-md-2 col-lg-2 form-group">
                        <label for="cep" >CEP:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span> 
                            <input type="text" class="form-control" id="cep" name="cep" required='required' 
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('CEP', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['CEP'] . '"';
                            	?>>
                        </div>
                    </div> 

                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="endereco" >Endereço:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span> 
                            <input type="text" class="form-control" id="endereco" name="endereco" required='required' 
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('endereco', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['endereco'] . '"'; 
                            	?>>
                        </div>
                     </div> 

                    <div class="col-md-4 col-lg-4 form-group">
                        <label for="bairro" >Bairro:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span> 
                            <input type="text" class="form-control" id="bairro" name="bairro" required='required'
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('setor', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['setor'] . '"';
                            	?>>
                        </div>
                    </div>
					
					<!--Linha 4 -->
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="complemento" >Complemento:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-plus"></i>
                            </span> 
                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="ex.: Quadra: 00,  Lote: 00"  
                            	<?php if(array_key_exists('nv', $_SESSION) && array_key_exists('complemento', $_SESSION['nv']))
                            		echo ' value="' . $_SESSION['nv']['complemento'] . '"';
                            	?>>
                        </div>
                    </div> 

                    <div class="col-md-4 col-lg-4 form-group">
                        <label for="cidade" >Cidade:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span> 
                            <input type="text" class="form-control" id="cidade" name="cidade" required='required'
                            	<?php if(array_key_exists('nv', $_SESSION) && array_key_exists('cidade', $_SESSION['nv']))
                            		echo ' value="' . $_SESSION['nv']['cidade'] . '"';
                            	?>>
                        </div>
                     </div> 

                    <div class="col-md-2 col-lg-2 form-group">
                        <label for="uf" >UF:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-globe"></i>
                            </span> 
                            <input type="text" class="form-control" id="uf" name="uf" required='required'
                            	<?php if(array_key_exists('nv', $_SESSION) && array_key_exists('UF', $_SESSION['nv']))
                            		echo ' value="' . $_SESSION['nv']['UF'] . '"';
                            	?>>
                        </div>
                    </div>					               
                </div><!--Fim formulario dados pessoais-->

				<!--Botões-->				
				<div class="col col-md-12 col-lg-12 botao">      
                    <a href=
                    	<?php
                    		if($_GET['f2'] === 'c') echo '"../index.php"';
                    		if($_GET['f2'] === 'e') echo '"../Consultas/"';
                    		if($_GET['f2'] === 'n') echo '"../Notificacoes/"';
							if($_GET['f2'] === 'ep') echo '"../"';
                    	?> class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary" name="continuar_dadospessoais" onclick="verificarInputsIndex()">
                    Continuar </button>
                </div>
            </form>

        </div> <!--Fim container-->

        <?php include(RODAPE_TEMPLATE); ?>


        <!--JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="js-formularios/mascaras.js"></script>
        <script type="text/javascript" src="js-formularios/verificacpf.js"></script>

    </body>
</html>
