<!--Configuração do acesso ao banco de dados e das variáveis, no define, e dos caminhos que precisam ser instanciadas como variáveis-->

<?php

/* O nome do banco de dados*/
define('DB_NAME', 'db_name');

/* Usuário do banco de dados MySQL */
define('DB_USER', 'db_user');

/* Senha do banco de dados MySQL */
define('DB_PASSWORD', 'db_password');

/* Nome do host do MySQL */
define('DB_HOST', 'localhost');

/* Caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/* Caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', '/sicam/');
	
/* Caminho do arquivo de banco de dados na própria máquina*/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . 'inc/banco.php');

/* Verifica se está logado no sistema*/
if ( !defined('VERIFICA_LOGADO') )
	define('VERIFICA_LOGADO', ABSPATH . 'verifica.php');

/* Verifica novo cadastro*/
if ( !defined('VERIFICA_NVCPF') )
	define('VERIFICA_NVCPF', ABSPATH . 'administrativo/Formularios/verifica.php');

/*Definindo arquivos de cabeçalho e rodapé justamente para não ficar copiando código*/
define('CABECALHO_TEMPLATE', ABSPATH . 'inc/cabecalho.php');
define('RODAPE_TEMPLATE', ABSPATH . 'inc/rodape.php');

?>
