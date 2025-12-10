<?php
session_start();
include('conexao.php');

// Busca registros
$sql = "SELECT * FROM formulario ORDER BY id DESC";
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Alunos</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>

    /* ==========================================
       FUNDO ANIMADO ELEGANTE
       ========================================== */
    body {
        position: relative;
        min-height: 100vh;
        overflow-x: hidden;
        background: #dbe9ff;
        animation: fadeBody 0.6s ease;
    }

    @keyframes fadeBody {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .bg-aurora {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        filter: blur(80px);
        animation: auroraMove 12s infinite alternate ease-in-out;
        background: radial-gradient(circle at 20% 30%, #6fa8ff 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, #9ec2ff 0%, transparent 50%),
                    radial-gradient(circle at 50% 50%, #bcd6ff 0%, transparent 50%);
        opacity: 0.55;
    }

    @keyframes auroraMove {
        0%   { transform: translate(-5%, -5%) scale(1); }
        50%  { transform: translate(5%, 8%) scale(1.1); }
        100% { transform: translate(-3%, 4%) scale(1); }
    }


    /* ==========================================
       NAVBAR IGUAL À QUE VOCÊ ENVIOU
       ========================================== */

    .navbar {
        background: linear-gradient(135deg, #000000, #084298);
        animation: slideDown 0.9s ease forwards;
        backdrop-filter: blur(6px);
    }

    @keyframes slideDown {
        from {
            transform: translateY(-60px);
            opacity: 0;
            filter: blur(5px);
        }
        to {
            transform: translateY(0);
            opacity: 1;
            filter: blur(0);
        }
    }

    .nav-link {
        position: relative;
        transition: 0.3s ease;
        color: #ffffff !important;
    }

    .nav-link:hover {
        text-shadow: 0 0 8px #64b5ff;
    }

    .nav-link::after {
        content: "";
        width: 0%;
        height: 2px;
        background: white;
        position: absolute;
        left: 0;
        bottom: 0;
        transition: 0.3s;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .navbar-brand {
        color: #ffffff !important;
        transition: 0.3s;
    }

    .navbar-brand:hover {
        text-shadow: 0 0 10px #8ecaff;
    }


    /* ==========================================
       SEU CSS ORIGINAL (NÃO ALTERADO)
       ========================================== */

    .card {
        border-radius: 18px;
        border: none;
        backdrop-filter: blur(7px);
        background: rgba(255, 255, 255, 0.70);
        animation: floatCard 0.8s ease;
        box-shadow: 0 0 18px rgba(0, 0, 0, 0.15);
        transition: 0.3s;
    }

    .card:hover {
        box-shadow: 0 0 25px rgba(0, 90, 255, 0.25);
    }

    @keyframes floatCard {
        from { transform: translateY(15px); opacity: 0; }
        to   { transform: translateY(0); opacity: 1; }
    }

    table {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #d3ddff;
    }

    .table thead {
        background: linear-gradient(135deg, #0066ff, #004bd1);
        color: white;
        font-weight: bold;
        letter-spacing: 0.5px;
    }

    #tableBody tr {
        transition: 0.25s;
        border-bottom: 1px solid #e2e6ff;
    }

    #tableBody tr:hover {
        background: rgba(0, 98, 255, 0.12);
        transform: scale(1.01);
        box-shadow: 0 0 12px rgba(0, 94, 255, 0.18);
    }

    .badge-curso {
        background: #e7f0ff;
        padding: 5px 10px;
        border-radius: 12px;
        color: #004ecc;
        font-weight: 600;
    }

    .search-wrapper {
        position: relative;
    }

    .search-wrapper i {
        position: absolute;
        top: 11px;
        left: 12px;
        font-size: 18px;
        color: #0066ff;
        opacity: 0.7;
    }

    #search {
        border-radius: 10px;
        padding-left: 40px;
        transition: 0.3s;
        border: 2px solid #b7ccff;
    }

    #search:focus {
        box-shadow: 0 0 13px rgba(0, 94, 255, 0.4);
        border-color: #0066ff;
    }

    .custom-btn {
        background: white;
        color: #0066ff;
        border-radius: 10px;
        padding: 6px 14px;
        transition: 0.3s;
        border: 2px solid white;
        font-weight: bold;
    }

    .custom-btn:hover {
        background: #004ccc;
        color: white;
        transform: scale(1.06);
    }

</style>

</head>
<body>

<!-- FUNDO ANIMADO -->
<div class="bg-aurora"></div>

<!-- NAVBAR NOVA (IGUAL À QUE VOCÊ ENVIU) -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="painel.php">EEEP MANOEL MANO</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="painel.php">Novo Cadastro</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="dados.php">Dashboard</a>
                </li>

                 <li class="nav-item">
                    <a class="nav-link" href="index.php">Sair</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow-lg">
        <div class="card-body">

            <h2 class="text-center mb-4 fw-bold text-primary title-animated">
                Lista de Alunos Cadastrados
            </h2>

            <div class="search-wrapper mb-3">
                <i class="bi bi-search"></i>
                <input type="text" id="search" class="form-control" placeholder="Buscar por nome, CPF ou curso...">
            </div>

            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>CEP</th>
                            <th>Curso</th>
                            <th>Responsável</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td><?= htmlspecialchars($row['cpf']) ?></td>
                            <td><?= htmlspecialchars($row['cep']) ?></td>
                            <td><span class="badge-curso"><?= htmlspecialchars($row['curso']) ?></span></td>
                            <td><?= htmlspecialchars($row['responsavel']) ?></td>
                            <td>
                                <a href="painel.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('search').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? "" : "none";
    });
});
</script>

</body>
</html>
