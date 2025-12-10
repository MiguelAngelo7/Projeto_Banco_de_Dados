<?php
// conexao.php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'login');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);
if (!$conexao) {
    die('Não foi possível conectar: ' . mysqli_connect_error());
}
?>
