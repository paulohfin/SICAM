<?php require_once '../configuracao.php'; ?>
<?php require_once DBAPI; ?>
<?php require_once VERIFICA_LOGADO; ?>
<?php require_once 'funcoes.php'; ?>

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
        <!--CDN do Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="css-pagina-inicial/estilo_inicial.css" >
        
        <title>Página Inicial</title>
    </head>

    <body class="col-md-12 col-lg-12">
        
        
    <?php include(CABECALHO_TEMPLATE); ?>
	
	<!--Botões de acesso a serviços da página -->
        <div id="container">
			<?php if($_SESSION['tipo'] === '2'): ?>
			
            <div id="box-1" class="box box-1">
                <a href="Formularios/index.php?f1=1&f2=c" id="texto-link">
                    <i class="material-icons icons-designe" style="font-size:90px; color: #1D2D6B; ">account_box</i>
                    <br>
                    <span class="icons-fonte">Cadastrar Estagiário</span>
                </a>
            </div>

            <div id="box-2" class="box box-1">
                <a href="Formularios/index.php?f1=2&f2=c" id="texto-link">
                    <i class="material-icons icons-designe" style="font-size:90px; color: #1D2D6B; ">assignment_ind</i>
                    <br>
                    <span class="icons-fonte">Cadastrar Supervisor</span>
                </a>
            </div>
			<?php endif ?>
			
            <div id="box-3" class="box box-1"> 
                <a href="Consultas/" id="texto-link">
					<i class="material-icons icons-designe" style="font-size:90px; color: #1D2D6B; ">find_in_page</i>
					<br>
					<span class="icons-fonte">Consultar Estagiário</span>
                </a>
            </div>
            <div id="box-4" class="box box-1">
                <a href="Notificacoes/" id="texto-link">
					<i class="material-icons icons-designe" style="font-size:90px; color: #1D2D6B; ">
					mail</i>
					<br>
					<span class="icons-fonte">Notificações</span>
                </a>
            </div>
        </div>       

        <?php include(RODAPE_TEMPLATE); ?>

    </body>
    
</html>
