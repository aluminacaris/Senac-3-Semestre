<?php
session_start();
require_once 'classes/usuario.class.php';

// Se já estiver logado, redirecionar
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: index.php");
    exit;
}

$usuario = new usuario();
$sucesso_cadastro = false;
$erro_login = '';
$erro_cadastro = '';

// Processar LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $login_valido = false;
    $usuario_logado = null;

    $usuarios = $usuario->listar();

    foreach ($usuarios as $user) {
        if ($user['email'] === $email && password_verify($senha, $user['senha'])) {
            $login_valido = true;
            $usuario_logado = $user;
            break;
        }
    }

    if ($login_valido) {
        $_SESSION['usuario_logado'] = $usuario_logado;
        $_SESSION['logado'] = true;

        $usuario->atualizarUltimoLogin($usuario_logado['id']);

        header("Location: index.php");
        exit;
    } else {
        $erro_login = "Email ou senha incorretos!";
    }
}

// Processar CADASTRO
if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome_cadastro'] ?? '';
    $email = $_POST['email_cadastro'] ?? '';
    $senha = $_POST['senha_cadastro'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Validações
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro_cadastro = "Todos os campos são obrigatórios!";
    } elseif ($senha !== $confirmar_senha) {
        $erro_cadastro = "As senhas não coincidem!";
    } elseif (strlen($senha) < 6) {
        $erro_cadastro = "A senha deve ter pelo menos 6 caracteres!";
    } else {
        // Tentar cadastrar
        $resultado = $usuario->adicionar($nome, $email, $senha, 'user');

        if ($resultado === TRUE) {
            $sucesso_cadastro = true;
            // Limpar os campos do formulário
            $_POST = array();
        } else {
            $erro_cadastro = "Erro ao cadastrar. Email já existe!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login - AgendaSenac2025</title>
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <h1>🔐 Login</h1>

            <!-- <?php if (isset($erro_login)): ?>
                <div class="alert alert-error"><?php echo $erro_login; ?></div>
            <?php endif; ?> -->

            <?php if ($sucesso_cadastro): ?>
                <div class="alert alert-success">
                    ✅ Conta criada com sucesso! Faça login com suas credenciais.
                </div>
            <?php endif; ?>

            <!-- Formulário de Login -->
            <form method="POST" action="">
                <input type="hidden" name="login" value="1">

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="seu@email.com"
                        value="<?php echo $_POST['email'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required placeholder="Sua senha">
                </div>

                <button type="submit" class="botao-login">Entrar</button>
            </form>

            <div class="divisor">
                <span>ou</span>
            </div>

            <!-- Botão para abrir modal de cadastro -->
            <button onclick="abrirModalCadastro()" class="botao-cadastro">
                📝 Criar Nova Conta
            </button>


        </div>
    </div>

    <!-- Modal de Cadastro -->
    <div id="modalCadastro" class="modal">
        <div class="modal-content">
            <span class="fechar" onclick="fecharModalCadastro()">&times;</span>
            <h2>📝 Criar Nova Conta</h2>

            <?php if (isset($erro_cadastro)): ?>
                <div class="alert alert-error"><?php echo $erro_cadastro; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="hidden" name="cadastro" value="1">

                <div class="form-group">
                    <label for="nome_cadastro">Nome:</label>
                    <input type="text" id="nome_cadastro" name="nome_cadastro" required placeholder="Seu nome completo"
                        value="<?php echo $_POST['nome_cadastro'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email_cadastro">Email:</label>
                    <input type="email" id="email_cadastro" name="email_cadastro" required placeholder="seu@email.com"
                        value="<?php echo $_POST['email_cadastro'] ?? ''; ?>">
                </div>

                <div class="form-group">
                    <label for="senha_cadastro">Senha:</label>
                    <input type="password" id="senha_cadastro" name="senha_cadastro" required
                        placeholder="Mínimo 6 caracteres" minlength="6">
                </div>

                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required
                        placeholder="Digite a senha novamente">
                </div>

                <button type="submit" class="botao-cadastro-form">Criar Conta</button>
            </form>
        </div>
    </div>

    <script>
        // Funções para o modal
        function abrirModalCadastro() {
            document.getElementById('modalCadastro').style.display = 'block';
            // Limpar mensagens de erro ao abrir o modal
            document.querySelectorAll('.alert-error').forEach(function (el) {
                el.style.display = 'none';
            });
        }

        function fecharModalCadastro() {
            document.getElementById('modalCadastro').style.display = 'none';
            // Limpar o formulário ao fechar
            document.querySelector('form[action=""] input[name="cadastro"]').closest('form').reset();
        }

        // Fechar modal clicando fora
        window.onclick = function (event) {
            var modal = document.getElementById('modalCadastro');
            if (event.target == modal) {
                fecharModalCadastro();
            }
        }

        // Auto-fechar o modal se cadastro foi bem-sucedido
        <?php if ($sucesso_cadastro): ?>
            document.getElementById('modalCadastro').style.display = 'none';

            // Rolagem suave para a mensagem de sucesso
            setTimeout(function () {
                document.querySelector('.alert-success')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 100);
        <?php endif; ?>

        // Manter modal aberto se houve erro no cadastro
        <?php if (isset($_POST['cadastro']) && !$sucesso_cadastro): ?>
            document.getElementById('modalCadastro').style.display = 'block';

            // Rolagem para o erro
            setTimeout(function () {
                document.querySelector('.alert-error')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 100);
        <?php endif; ?>

        // Focar no primeiro campo quando modal abrir
        document.getElementById('modalCadastro').addEventListener('shown', function () {
            document.getElementById('nome_cadastro').focus();
        });
    </script>
</body>

</html>