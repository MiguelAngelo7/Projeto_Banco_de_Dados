<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-9 col-sm-10">

                <div class="card shadow-lg">
                    <div class="card-body p-5">

                        <h1 class="fs-4 card-title fw-bold mb-4 text-center">
                            Cadastro de Alunos
                        </h1>

                        <form action="salvar_formulario.php" method="POST" autocomplete="off">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CPF</label>
                                    <input type="text" class="form-control" name="cpf" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control" name="cep" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rua</label>
                                    <input type="text" class="form-control" name="rua" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-control" name="numero" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nome do Responsável</label>
                                    <input type="text" class="form-control" name="responsavel">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Curso</label>
                                    <select class="form-select" name="curso" required>
                                        <option value="">Selecione...</option>
                                        <option value="Desenvolvimento de Sistemas">Desenvolvimento de Sistemas</option>
                                        <option value="Informática">Informática</option>
                                        <option value="Administração">Administração</option>
                                        <option value="Enfermagem">Enfermagem</option>
                                    </select>
                                </div>

                            </div>

                            <button class="btn btn-primary w-100 mt-3" type="submit">
                                Enviar Formulário
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
