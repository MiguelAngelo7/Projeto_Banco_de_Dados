<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Bootstrap 5 Login Page</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
		/* Fundo azul degradê */
		body {
			background: linear-gradient(135deg, #0d6efd, #0b5ed7, #0a58ca);
			height: 100vh;
			overflow: hidden;
			position: relative;
		}

		/* ANIMAÇÃO DE BOLHAS DO FUNDO */
		.animation-bg {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			overflow: hidden;
			z-index: 0;
		}

		.animation-bg span {
			position: absolute;
			display: block;
			width: 25px;
			height: 25px;
			background: rgba(255, 255, 255, 0.25);
			border-radius: 50%;
			bottom: -50px;
			animation: bubble 10s linear infinite;
		}

		@keyframes bubble {
			0%   { transform: translateY(0) rotate(0deg); opacity: 1; }
			100% { transform: translateY(-800px) rotate(360deg); opacity: 0; }
		}

		/* Diferentes bolhas */
		.animation-bg span:nth-child(1) { left: 10%; animation-duration: 8s; }
		.animation-bg span:nth-child(2) { left: 20%; animation-duration: 12s; width: 35px; height: 35px; }
		.animation-bg span:nth-child(3) { left: 35%; animation-duration: 10s; }
		.animation-bg span:nth-child(4) { left: 50%; animation-duration: 14s; width: 40px; height: 40px; }
		.animation-bg span:nth-child(5) { left: 65%; animation-duration: 9s; }
		.animation-bg span:nth-child(6) { left: 80%; animation-duration: 11s; width: 30px; height: 30px; }
		.animation-bg span:nth-child(7) { left: 90%; animation-duration: 13s; }

		/* Card sobre a animação */
		.card {
			position: relative;
			z-index: 10;
		}

		/* ---✨ EFEITO DE BRILHO NA LOGO (igual ao INDEX) --- */
		.logo-glow {
			transition: 0.3s ease-in-out;
			filter: drop-shadow(0 0 0px rgba(255,255,255,0));
			cursor: pointer;
		}

		.logo-glow:hover {
			filter: drop-shadow(0 0 10px #64b5ff) brightness(1.25);
			transform: scale(1.05);
		}
	</style>
</head>

<body>

	<!-- ANIMAÇÃO DE FUNDO -->
	<div class="animation-bg">
		<span></span><span></span><span></span><span></span>
		<span></span><span></span><span></span>
	</div>

	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

					<div class="text-center my-5">
						<img src="ChatGPT Image 2 de dez. de 2025, 14_13_46-Photoroom.png" 
							 alt="logo" width="100" class="logo-glow">
					</div>

					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>

							<!--Mensagem de cadastro inicio-->
							<?php if(isset($_SESSION['mensagem'])): ?>
								<div class="alert alert-info alert-dismissible fade show" role="alert">
									<?= $_SESSION['mensagem']; ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
								</div>
							<?php unset($_SESSION['mensagem']); endif; ?>
							<!--Mensagem de cadastro fim-->

							<form action="cadastro.php" method="POST" class="needs-validation" novalidate="" autocomplete="off">
								
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Name</label>
									<input id="name" type="text" class="form-control" name="nome" required autofocus>
									<div class="invalid-feedback">Name is required</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">Email is invalid</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="senha" required>
									<div class="invalid-feedback">Password is required</div>
								</div>

								<p class="form-text text-muted mb-3">
									By registering you agree with our terms and conditions.
								</p>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										Register
									</button>
								</div>

							</form>
						</div>

						<div class="card-footer py-3 border-0 text-center">
							Already have an account?
							<a href="index.php" class="text-dark fw-bold">Login</a>
						</div>

					</div>

					<div class="text-center mt-5 text-light">
						Copyright © 2025 — Your Company 
					</div>

				</div>
			</div>
		</div>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
