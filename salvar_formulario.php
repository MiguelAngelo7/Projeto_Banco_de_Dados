<?php
session_start();
include('conexao.php');

// Função para validar CPF (números)
function validarCPF($cpf){
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) return false;
    if (preg_match('/^(.)\1{10}$/', $cpf)) return false;
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false;
    }
    return true;
}

// Verifica método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['mensagem'] = "Requisição inválida.";
    header('Location: painel.php');
    exit();
}

// Recebe ID (SE EXISTIR = editar)
$id = $_POST['id'] ?? '';

// Campos obrigatórios
$req = ['nome','rua','numero','bairro','cep','cpf','curso'];
foreach ($req as $r) {
    if (empty($_POST[$r])) {
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
        header('Location: painel.php');
        exit();
    }
}

// Recebe e limpa dados
$nome = trim($_POST['nome']);
$rua = trim($_POST['rua']);
$numero = trim($_POST['numero']);
$bairro = trim($_POST['bairro']);
$cep = trim($_POST['cep']);
$cpf_raw = trim($_POST['cpf']);
$cpf_digits = preg_replace('/\D/','',$cpf_raw);
$responsavel = trim($_POST['responsavel'] ?? '');
$curso = trim($_POST['curso']);

// Valida CPF
if (!validarCPF($cpf_digits)) {
    $_SESSION['mensagem'] = "CPF inválido.";
    header('Location: painel.php');
    exit();
}

// ======================================================
// SE NÃO TIVER ID → INSERIR
// SE TIVER ID → EDITAR
// ======================================================

if ($id == "") {
    // --- INSERT ---
    $sql = "INSERT INTO formulario 
        (nome, rua, numero, bairro, cep, cpf, responsavel, curso)
        VALUES (?,?,?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss",
        $nome, $rua, $numero, $bairro, $cep, $cpf_digits, $responsavel, $curso
    );

    $acao = "cadastrado";

} else {
    // --- UPDATE ---
    $sql = "UPDATE formulario SET
        nome=?, rua=?, numero=?, bairro=?, cep=?, cpf=?, responsavel=?, curso=?
        WHERE id=?";
    
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssi",
        $nome, $rua, $numero, $bairro, $cep, $cpf_digits, $responsavel, $curso, $id
    );

    $acao = "atualizado";
}

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['mensagem'] = "Aluno $acao com sucesso!";
} else {
    $_SESSION['mensagem'] = "Erro: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);

header("Location: list.php");
exit();
?>
