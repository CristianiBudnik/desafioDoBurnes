<div class="login">
    <div class="card shadow">
        <div class="card-header">
            <img src="../imgs/logo.svg" alt="Logo do Painel"
            class="w-100">
        </div>
        <div class="card-body">
            <form name="formLogin" method="post" action="index.php"
            data-parsley-validate>
                <label for="email">Digite o e-mail:</label>
                <input type="email" name="email" id="email" required
                class="form-control"
                data-parsley-required-message="Preencha este campo"
                data-parsley-type-message="Digite um e-mail válido">
                
                <label for="senha">Digite sua senha:</label>
                <input type="password" name="senha" id="senha"
                required class="form-control"
                data-parsley-required-message="Preencha este campo">
                <br>
                <button type="submit" class="btn btn-success w-100">
                    Efetuar Login
                </button>
            </form>
        </div>
    </div>
</div>