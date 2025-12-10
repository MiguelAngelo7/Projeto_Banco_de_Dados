<?php
session_start();
include('navbar.php');
include('verifica_login.php');
include('conexao.php');

/* ===========================================
        CARREGAR ALUNO PARA EDIÇÃO
=========================================== */
$editando = false;
$aluno = [];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $busca = mysqli_query($conexao, "SELECT * FROM formulario WHERE id = $id LIMIT 1");
    if (mysqli_num_rows($busca) > 0) {
        $aluno = mysqli_fetch_assoc($busca);
        $editando = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* === Fundo Minimalista Premium === */
body {
    background: linear-gradient(135deg, #f8f9fa, #e9eef5);
    height: 100vh;
    overflow-x: hidden;
    position: relative;
}

/* === ANIMAÇÃO EXTRA: PARTÍCULAS SUAVES === */
.particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: -1;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: rgba(0,0,0,0.12);
    border-radius: 50%;
    animation: particleMove linear infinite;
    filter: blur(1px);
}

@keyframes particleMove {
    0% { transform: translateY(-10px) translateX(0); opacity: 1; }
    100% { transform: translateY(120vh) translateX(20px); opacity: 0; }
}

/* Entrada suave do card */
.card {
    animation: fadeInUp 0.7s ease forwards;
    opacity: 0;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Labels animados */
.form-label {
    animation: labelFade 0.6s ease both;
}
@keyframes labelFade {
    from { opacity: 0; transform: translateX(-10px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* Inputs premium */
.form-control, .form-select {
    border-radius: 10px;
    transition: 0.3s;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0px 0px 6px rgba(0, 123, 255, 0.5);
    transform: scale(1.01);
}

/* Botão premium */
.btn-primary {
    border-radius: 10px;
    padding: 12px;
    font-size: 1.1rem;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: scale(1.02);
    background-color: #0a58ca;
}

</style>
</head>

<body>

<!-- PARTÍCULAS -->
<div class="particles"></div>

<script>
for (let i = 0; i < 25; i++) {
    let p = document.createElement("div");
    p.classList.add("particle");
    p.style.left = Math.random() * 100 + "vw";
    p.style.animationDuration = 6 + Math.random() * 7 + "s";
    p.style.animationDelay = Math.random() * 5 + "s";
    document.querySelector(".particles").appendChild(p);
}
</script>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Olá, <?php echo $_SESSION['email']; ?></h3>
    </div>

    <!-- Mensagem -->
    <?php if(isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-info"><?= $_SESSION['mensagem']; ?></div>
    <?php unset($_SESSION['mensagem']); endif; ?>

    <!-- FORMULÁRIO -->
    <section class="h-100 mt-5">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-9 col-sm-10">

                    <div class="card shadow-lg">
                        <div class="card-body p-5">

                            <h1 class="fs-4 card-title fw-bold mb-4 text-center">
                                <?= $editando ? "Editar Aluno" : "Cadastro de Alunos" ?>
                            </h1>

<form action="salvar_formulario.php" method="POST" autocomplete="off">

    <input type="hidden" name="id" value="<?= $editando ? $aluno['id'] : '' ?>">

    <div class="row">

        <div class="col-md-12 mb-3">
            <label class="form-label">Nome Completo</label>
            <input type="text" class="form-control" name="nome" value="<?= $editando ? $aluno['nome'] : '' ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">CPF</label>
            <input type="text" class="form-control" name="cpf" value="<?= $editando ? $aluno['cpf'] : '' ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Idade</label>
            <input type="number" class="form-control" name="idade" value="<?= $editando ? $aluno['idade'] : '' ?>" required>
        </div>

        <!-- SEXO -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Sexo</label>
            <select class="form-select" name="sexo" required>
                <option value="">Selecione...</option>
                <option value="Masculino" <?= ($editando && $aluno['sexo']=="Masculino") ? "selected" : "" ?>>Masculino</option>
                <option value="Feminino" <?= ($editando && $aluno['sexo']=="Feminino") ? "selected" : "" ?>>Feminino</option>
                <option value="Outro" <?= ($editando && $aluno['sexo']=="Outro") ? "selected" : "" ?>>Outro</option>
            </select>
        </div>

        <!-- TURNO -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Turno</label>
            <select class="form-select" name="turno" required>
                <option value="">Selecione...</option>
                <option value="Manhã" <?= ($editando && $aluno['turno']=="Manhã") ? "selected" : "" ?>>Manhã</option>
                <option value="Tarde" <?= ($editando && $aluno['turno']=="Tarde") ? "selected" : "" ?>>Tarde</option>
                <option value="Noite" <?= ($editando && $aluno['turno']=="Noite") ? "selected" : "" ?>>Noite</option>
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $editando ? $aluno['email'] : '' ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">CEP</label>
            <input type="text" class="form-control" name="cep" value="<?= $editando ? $aluno['cep'] : '' ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Rua</label>
            <input type="text" class="form-control" name="rua" value="<?= $editando ? $aluno['rua'] : '' ?>" required>
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Número</label>
            <input type="text" class="form-control" name="numero" value="<?= $editando ? $aluno['numero'] : '' ?>" required>
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Bairro</label>
            <input type="text" class="form-control" name="bairro" value="<?= $editando ? $aluno['bairro'] : '' ?>" required>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" name="cidade" value="<?= $editando ? $aluno['cidade'] : '' ?>" required>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Responsável</label>
            <input type="text" class="form-control" name="responsavel" value="<?= $editando ? $aluno['responsavel'] : '' ?>">
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Curso</label>
            <select class="form-select" name="curso" required>
                <option value="">Selecione...</option>

                <option value="Desenvolvimento de Sistemas" <?= ($editando && $aluno['curso']=="Desenvolvimento de Sistemas") ? "selected" : "" ?>>Desenvolvimento de Sistemas</option>

                <option value="Informática" <?= ($editando && $aluno['curso']=="Informática") ? "selected" : "" ?>>Informática</option>

                <option value="Administração" <?= ($editando && $aluno['curso']=="Administração") ? "selected" : "" ?>>Administração</option>

                <option value="Enfermagem" <?= ($editando && $aluno['curso']=="Enfermagem") ? "selected" : "" ?>>Enfermagem</option>
            </select>
        </div>

    </div>

    <button class="btn btn-primary w-100 mt-3" type="submit">
        <?= $editando ? "Salvar Alterações" : "Enviar Formulário" ?>
    </button>
</form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

</body>
</html>
