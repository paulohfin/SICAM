
<?php	
	if(isSet($_GET['logout']) == 1){
		session_destroy();
		echo '<script>location.href="../index.php"</script>';
		
	}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
     </head>

    <body>

    <!--Barra de navegação superior das telas -->
        <nav class="navbar navbar-fixed-top" role="navigation" style="background: #1D2D6B; padding: 10px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed btn btn-info active" data-toggle="collapse" data-target="#barra-navegacao">
                        <span class="sr-only">Alternar Menu</span>
                        <span class="glyphicon glyphicon-list-alt" style="color: #fff; font-size: 20px"></span>
                    </button>
                    <h3 style="font-family: verdana; color: #fff">SICAM </h3>
                </div>

                <div class="collapse navbar-collapse" id="barra-navegacao">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="<?php echo BASEURL; ?>"><span class="glyphicon glyphicon-home"></span>  Início</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Perfil  <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="background:#ECEFF1">
                                <li role="presentation"><a role="menuitem" href=<?php echo BASEURL . 'administrativo/Formularios/perfil.php'; ?>><span class="glyphicon glyphicon-edit"></span>  Editar</a></li>
                                <li role="presentation" class="divider" style="background:#bbdefb"></li>
                                <li role="presentation"><a role="menuitem" href=<?php echo BASEURL . 'inc/perfil/alterar_senha.php'; ?>><span class="glyphicon glyphicon-check"></span>  Alterar Senha</a></li>
                            </ul>
                        </li>
                        <li><a href="?logout=1"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
                    </ul>
                </div> <!--DIV DA NAVBAR -->

            </div>            
        </nav>

        <div style="padding-bottom: 100px">            
            <!--ESPAÇAMENTO NECESSÁRIO ENTRE A BARRA DE NAVEGAÇÃO PRINCIPAL E OS DEMAIS COMPONENTES NA TELA-->
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>