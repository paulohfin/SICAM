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
        <title>Dados do Contrato</title>

        <!--PASTA CSS DOS FORMULÁRIOS -->
        <link rel="stylesheet" href="css-formularios/estilo.css" >


        <!--ABAIXO: LINKs e SCRIPTs necessários para DATE PICKER do BOOTSTRAP -->

        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>

        <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" /> 

    </head>

    <body> 
        <?php
			include(CABECALHO_TEMPLATE);
			buscarlotacao();
			buscarsupervisor();
		?>   

        <div class="container">
            
            <!--Barra de navegação da tabela com DADOS CONTRATO ativos-->  
			<div>
                <ul class="nav nav-tabs col col-md-11 col-lg-11">
                    <?php
                    	echo ($_GET['f2'] === 'c') ? '<li><a href="index.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'" >Dados Pessoais</a></li>' : '';
                    	echo ($_GET['f1'] === '1' && $_GET['f2'] === 'c') ? '<li><a href="escolaridade.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Escolaridade</a></li>' : '';
						echo '<li class="active"><a href="#">Dados do Contrato</a></li>';
						echo ($_GET['f2'] === 'c') ? '<li><a href= "banco.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'" >Informações Bancárias</a></li>' : '';
						echo ($_GET['f2'] === 'c') ? '<li><a href="login-senha.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'">Login e Senha</a></li>' : '';
					?>
                </ul>
            </div>
			
            <!--Formulário do contrato-->
			<form method="POST" class="row col col-md-12 col-lg-12 formulario"> 

				<div class="col col-md-12 col-lg-12">					
					<!--Linha 1 -->
    				<div class="col-md-12 col-lg-12 form-group">
    					<label >Convênio:</label>

    					<label class="radio-inline"><input type="radio" name="optradio"  value='CIEE'
    						<?php
    							if(array_key_exists('nv', $_SESSION) && array_key_exists('convenio', $_SESSION['nv']))
    								echo ($_SESSION['nv']['convenio'] === 'CIEE') ? 'checked' : null;
    							echo ($_GET['f2'] === 'c' || $_GET['f2'] === 'cn' || $_GET['f2'] === 'ce') ? ' required="required"' : " readonly";
    						?> >CIEE</label>

    					<label class="radio-inline"><input type="radio" name="optradio"  value='IEL'
    						<?php
    							if(array_key_exists('nv', $_SESSION) && array_key_exists('convenio', $_SESSION['nv']))
    								echo ($_SESSION['nv']['convenio'] === 'IEL') ? 'checked' : null;
    							echo ($_GET['f2'] === 'c' || $_GET['f2'] === 'cn' || $_GET['f2'] === 'ce') ? ' required="required"' : " readonly";
    						?> >IEL</label>
    				</div>
					
					<!--Linha 2 -->
                    <div class="col-md-4 col-lg-4 form-group">
                        <label for="lotacao" >Lotação:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </span> 
							<?php 
								if(($_GET['f2'] === 'c' || $_GET['f2'] === 'cn' || $_GET['f2'] === 'ce') && $_SESSION['tipo'] === '2'){
									echo '<select class="form-control" id="situacao-Contrato" style="font-size: 16px" name="lotacao">
										<<option value="0">Selecione a lotação</option>';
									foreach($lotacao as $lot)
											echo '<option value="' . $lot['id_lotacao'] . '">' . $lot['lotacao_nome'] . '</option>';
									echo '</select>';
								}
								else{
									echo '<input type="text" class="form-control" id="lotacao" name="lotacao"';
									if(array_key_exists('nv', $_SESSION) && array_key_exists('lotacao_nome', $_SESSION['nv']))
										echo ' value="' . $_SESSION['nv']['lotacao_nome'] . '"';
									echo ' readonly';
								}
                            ?> >
                        </div>
                    </div> 
                    
                    <div class="col-md-2 col-lg-2 form-group">
                        <label for="valor" >Valor:</label>
                         <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-usd"></i>
                            </span> 
                            <input type="text" class="form-control" id="valor" name="valor"
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('valor_estagio', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['valor_estagio'] . '"';
                            		echo (($_GET['f2'] === 'c' || $_GET['f2'] === 'cn' || $_GET['f2'] === 'ce') && ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3')) ? " required='required'" : ' readonly';
    							?> >
                        </div>
                    </div> 
                   
                    <div class="col-md-6 col-lg-6 form-group">
                        <label for="supervisor" >Supervisor:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span> 
                            <input type="text" class="form-control" id="supervisor" name="supervisor"
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('supervisor', $_SESSION['nv']))
                            			echo ' value="' . $_SESSION['nv']['supervisor'] . '"';
                            		echo (($_GET['f2'] === 'c' || $_GET['f2'] === 'cn' || $_GET['f2'] === 'ce') && ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3')) ? " required='required'" : ' readonly';
                            	?> >
                        </div>
                    </div> 

						<!--Linha 3 -->
                    <div class="col-md-3 col-lg-3 form-group">
                        <label for="dataInicioEstagio" >Data de Início do Estágio:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                            <input type="text" class="form-control" id="dataInicioEstagio" name='dataInicioEstagio' 
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('data_inicio', $_SESSION['nv']))
                            			echo ' value="' . date("d/m/Y", strtotime($_SESSION['nv']['data_inicio'])) . '"';
                            		echo (($_GET['f2'] === 'c' || $_GET['f2'] === 'cn' || $_GET['f2'] === 'ce') && ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3')) ? " required='required'" : ' readonly';
                            	?> >
                        </div>
                    </div> 

                    <div class="col-md-3 col-lg-3 form-group">
                        <label for="dataFimEstagio" >Data do Fim do Estágio:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                            <input type="text" class="form-control" id="dataFimEstagio" name='dataFimEstagio'
                            	<?php
                            		if(array_key_exists('nv', $_SESSION) && array_key_exists('data_fim', $_SESSION['nv']))
                            			echo ' value="' . date("d/m/Y", strtotime($_SESSION['nv']['data_fim'])) . '"';
                            		echo ($_SESSION['tipo'] === '2' || $_SESSION['tipo'] === '3') ? " required='required'" : ' readonly';
    							?>>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-6  form-group">
                        <label for="situacao-Contrato">Situação do Contrato</label>
                        <div>
                            <select class="form-control" id="situacao-Contrato" style="font-size: 16px" name='situacao-Contrato' >
                                <option value=<?php echo (array_key_exists('nv', $_SESSION) && array_key_exists('situacao_contrato', $_SESSION['nv'])) ? $_SESSION['nv']['situacao_contrato'] : '0' ?> >
                                	<?php
                                		echo (array_key_exists('nv', $_SESSION) && array_key_exists('situacao_contrato', $_SESSION['nv'])) ? situacaocontrato($_SESSION['nv']['situacao_contrato']) : situacaocontrato() ;
                                	?></option>
                                <option value="1">Checando CPF</option>
                                <option value="2">Contrato está no CIEE/IEL</option>
                                <option value="3">Contrato está com o estagiário</option>
                                <option value="4">Estagiário contratado</option>
                                <option value="5">Estagiário está de férias</option>
                                <option value="6">Contrato rescindido</option>
                            </select>                        
                        </div>
                    </div> 
    			</div><!--Fim formulario de contrato-->

				<!--Botões-->
				<div class="col col-md-12 col-lg-12 botao">                 
                    <a href=
                    	<?php
                    		if($_GET['f2'] === 'c') echo '"../index.php"';
                    		if($_GET['f2'] === 'e') echo '"../Consultas/"';
                    		if($_GET['f2'] === 'n') echo '"../Notificacoes/"';
                    	?> class="btn btn-default">Cancelar</a>
                    <a href="#" style="text-decoration: none"> 
                        <button type="submit" class="btn btn-primary" name="continuar_contrato" onclick="verificarInputsIndex()">Continuar</button>
                    </a>
                </div>
			</form>
        </div>  <!--Fim container-->

        <?php include(RODAPE_TEMPLATE); ?>   

        
        <!--SCRIPTS PARA FUNCIONAR O DATE-PICKER -->     
        
        <!--  jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Bootstrap Date-Picker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        
        <!--MÁSCARAS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        
        <!--PASTA JS -->
        <script type="text/javascript" src="js-formularios/mascaras.js"></script>

    </body>
</html>
