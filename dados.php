<?php
session_start();
include('conexao.php');

// ===== TOTAL DE ALUNOS =====
$sql_total = "SELECT COUNT(*) AS total FROM formulario";
$result_total = mysqli_query($conexao, $sql_total);
$total = mysqli_fetch_assoc($result_total)['total'];

// ===== ALUNOS POR CURSO =====
$sql_cursos = "SELECT curso, COUNT(*) AS qtd FROM formulario GROUP BY curso ORDER BY qtd DESC";
$result_cursos = mysqli_query($conexao, $sql_cursos);

$cursos = [];
$quantidades = [];

while ($row = mysqli_fetch_assoc($result_cursos)) {
    $cursos[] = $row['curso'];
    $quantidades[] = $row['qtd'];
}

// ===== MAIOR E MENOR CURSO =====
$cursoMais = $cursos[0];
$cursoMaisQtd = $quantidades[0];

$cursoMenos = $cursos[count($cursos)-1];
$cursoMenosQtd = $quantidades[count($quantidades)-1];

// ======== NOVA CONSULTA: TURNOS ========

$sql_turnos = "SELECT turno, COUNT(*) AS qtd 
               FROM formulario 
               WHERE turno IN ('Manhã', 'Tarde', 'Noite')
               GROUP BY turno
               ORDER BY FIELD(turno, 'Manhã', 'Tarde', 'Noite')";

$result_turnos = mysqli_query($conexao, $sql_turnos);

$turnos = [];
$turnosQtd = [];

while ($row = mysqli_fetch_assoc($result_turnos)) {
    $turnos[] = $row['turno'];
    $turnosQtd[] = $row['qtd'];
}

// ======================================================
// =============== 10 NOVAS CONSULTAS ===================
// ======================================================

$sql_t1 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario");
$t1 = mysqli_fetch_assoc($sql_t1)['total'];

$sql_t2 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario WHERE sexo='Masculino'");
$t2 = mysqli_fetch_assoc($sql_t2)['total'];

$sql_t3 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario WHERE sexo='Feminino'");
$t3 = mysqli_fetch_assoc($sql_t3)['total'];

$sql_t4 = mysqli_query($conexao, "SELECT AVG(idade) AS media FROM formulario");
$t4 = round(mysqli_fetch_assoc($sql_t4)['media'], 1);

$sql_t5 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario WHERE curso='ADM'");
$t5 = mysqli_fetch_assoc($sql_t5)['total'];

$sql_t6 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario WHERE curso='Enfermagem'");
$t6 = mysqli_fetch_assoc($sql_t6)['total'];

$sql_t7 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario WHERE curso='Informática'");
$t7 = mysqli_fetch_assoc($sql_t7)['total'];

$sql_t8 = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM formulario WHERE email <> ''");
$t8 = mysqli_fetch_assoc($sql_t8)['total'];

$sql_t9 = mysqli_query($conexao, "SELECT MAX(idade) AS maior FROM formulario");
$t9 = mysqli_fetch_assoc($sql_t9)['maior'];

$sql_t10 = mysqli_query($conexao, "SELECT MIN(idade) AS menor FROM formulario");
$t10 = mysqli_fetch_assoc($sql_t10)['menor'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Dados</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background: linear-gradient(135deg, #020202, #000000, #050505);
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
}

.aurora {
    position: fixed;
    inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(0,120,255,0.4), transparent 60%),
        radial-gradient(circle at 80% 70%, rgba(200,70,255,0.25), transparent 60%),
        radial-gradient(circle at 50% 50%, rgba(0,180,255,0.25), transparent 60%);
    filter: blur(120px);
    animation: auroraFlow 12s infinite alternate ease-in-out;
    z-index: -1;
}

@keyframes auroraFlow {
    0% { transform: scale(1.1) translate(-3%, -3%); }
    50% { transform: scale(1.2) translate(4%, 4%); }
    100% { transform: scale(1.1) translate(-2%, 3%); }
}

.card {
    border-radius: 20px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 25px rgba(0,0,0,0.6);
    transition: 0.3s;
}
.card:hover {
    transform: scale(1.02);
    box-shadow: 0 0 30px rgba(0,120,255,0.7);
}
.card h4 {
    color: #dbe8ff;
    text-align: center;
}

h2 { color: white; }

.pizza-container {
    max-width: 400px;
    margin: 0 auto;
}

#graficoCursos, #graficoTurnos {
    max-height: 350px !important;
}
/* BOTÃO VOLTAR — EFEITO NEON PREMIUM */
.btn-back {
    padding: 12px 28px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 12px;
    color: #dbe8ff;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.2);
    text-decoration: none;
    backdrop-filter: blur(12px);
    transition: 0.35s ease-in-out;
    box-shadow: 0 0 12px rgba(0,0,0,0.6);
    display: inline-block;
}

/* Glow neon no hover */
.btn-back:hover {
    transform: scale(1.08) translateY(-3px);
    box-shadow: 0 0 22px rgba(0,140,255,0.9);
    border-color: rgba(0,140,255,0.8);
    color: #ffffff;
}

/* Efeito de clique */
.btn-back:active {
    transform: scale(0.96);
    box-shadow: 0 0 15px rgba(0,140,255,0.6);
}

</style>
</head>

<body>

<div class="aurora"></div>

<div class="container py-5">

<h2 class="text-center fw-bold mb-5">Dashboard de Dados</h2>

<!-- MAIS x MENOS -->
<div class="card mb-4">
    <h4>Mais cadastrado × Menos cadastrado</h4>
    <canvas id="graficoComparativo" height="140"></canvas>
</div>

<!-- GRAFICO DE CURSOS -->
<div class="card mb-4">
    <h4>Cursos cadastrados</h4>
    <div class="pizza-container">
        <canvas id="graficoCursos"></canvas>
    </div>
</div>

<!-- GRAFICO DE TURNOS -->
<div class="card mb-4">
    <h4>Turnos</h4>
    <div class="pizza-container">
        <canvas id="graficoTurnos"></canvas>
    </div>
</div>

<!-- 10 CARDS -->
<div class="row g-4 mt-4">
    <div class="col-md-3"><div class="card"><h4>Total Geral</h4><h2 class="text-center"><?= $t1 ?></h2></div></div>
    <div class="col-md-3"><div class="card"><h4>Homens</h4><h2 class="text-center"><?= $t2 ?></h2></div></div>
    <div class="col-md-3"><div class="card"><h4>Mulheres</h4><h2 class="text-center"><?= $t3 ?></h2></div></div>
    <div class="col-md-3"><div class="card"><h4>Média de Idade</h4><h2 class="text-center"><?= $t4 ?></h2></div></div>

    <div class="col-md-3"><div class="card"><h4>Com Email</h4><h2 class="text-center"><?= $t8 ?></h2></div></div>

    <div class="col-md-3"><div class="card"><h4>Maior Idade</h4><h2 class="text-center"><?= $t9 ?></h2></div></div>
    <div class="col-md-3"><div class="card"><h4>Menor Idade</h4><h2 class="text-center"><?= $t10 ?></h2></div></div>
</div>

<div class="text-center mt-4">
    <a href="list.php" class="btn-back">⬅ Voltar</a>
</div>

</div>

<script>
const cursos = <?= json_encode($cursos); ?>;
const quantidades = <?= json_encode($quantidades); ?>;
const turnos = <?= json_encode($turnos); ?>;
const turnosQtd = <?= json_encode($turnosQtd); ?>;

const cursoMais = "<?= $cursoMais ?>";
const cursoMaisQtd = <?= $cursoMaisQtd ?>;
const cursoMenos = "<?= $cursoMenos ?>";
const cursoMenosQtd = <?= $cursoMenosQtd ?>;

Chart.defaults.color = "#dbe8ff";
Chart.defaults.font.family = "Segoe UI";
Chart.defaults.font.size = 13;

// ===== GRÁFICO COMPARATIVO =====
new Chart(document.getElementById('graficoComparativo'), {
    type: 'bar',
    data: {
        labels: [cursoMais, cursoMenos],
        datasets: [{
            label: "Quantidade",
            data: [cursoMaisQtd, cursoMenosQtd],
            borderWidth: 3,
            borderRadius: 14,
            backgroundColor: [
                "rgba(0, 150, 255, 0.7)",
                "rgba(180, 70, 255, 0.7)"
            ],
            borderColor: [
                "rgba(0, 200, 255, 1)",
                "rgba(200, 120, 255, 1)"
            ]
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});

// ===== GRÁFICO DE CURSOS =====
new Chart(document.getElementById('graficoCursos'), {
    type: 'pie',
    data: {
        labels: cursos,
        datasets: [{
            data: quantidades,
            borderWidth: 3,
            hoverOffset: 20,
            borderColor: "rgba(255,255,255,0.35)",
            backgroundColor: [
                "rgba(0,150,255,0.8)",
                "rgba(180,70,255,0.8)",
                "rgba(0,220,180,0.8)",
                "rgba(255,80,120,0.8)",
                "rgba(255,180,0,0.8)"
            ]
        }]
    }
});

// ===== GRÁFICO DE TURNOS =====
new Chart(document.getElementById('graficoTurnos'), {
    type: 'doughnut',
    data: {
        labels: turnos,
        datasets: [{
            data: turnosQtd,
            borderWidth: 3,
            hoverOffset: 20,
            borderColor: "rgba(255,255,255,0.35)",
            backgroundColor: [
                "rgba(0,150,255,0.8)",   // Manhã
                "rgba(255,180,0,0.8)",   // Tarde
                "rgba(180,70,255,0.8)"   // Noite
            ]
        }]
    }
});
</script>

</body>
</html>
