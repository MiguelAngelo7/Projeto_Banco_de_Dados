<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Miguel">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Navbar Animada</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ESTILO + ANIMAÇÕES -->
    <style>
        /* Fade + Slide da Navbar */
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

        /* Links com efeito glow suave */
        .nav-link {
            position: relative;
            transition: 0.3s ease;
        }

        .nav-link:hover {
            color: #ffffff !important;
            text-shadow: 0 0 8px #64b5ff;
        }

        /* Efeito underline animado */
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

        /* Botão Home destacado */
        .navbar-brand {
            transition: 0.3s;
        }

        .navbar-brand:hover {
            text-shadow: 0 0 10px #8ecaff;
        }

        /* Efeito suave no scroll */
        body {
            animation: fadeBody 0.7s ease;
        }

        @keyframes fadeBody {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>

<body>

    <!-- NAVBAR ANIMADA -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container-fluid">

            <a class="navbar-brand text-light fw-bold" href="dados.php">Home</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link text-light" href="painel.php">Form</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="list.php">Lista</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">Sair</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

  

</body>
</html>
