<?php
// verifica_login.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se não existir email na sessão, redireciona para login
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
?>
