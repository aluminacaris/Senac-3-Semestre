<?php
session_start();

function verificarLogin()
{
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: login.php");
        exit;
    }
}

function getUsuarioLogado()
{
    return $_SESSION['usuario_logado'] ?? null;
}

function fazerLogout()
{
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

function temPermissao($permissao, $redirecionar = true)
{
    $usuario = getUsuarioLogado();

    if (!$usuario)
        return false;

    // Se for admin, tem todas as permissões
    if ($usuario['permissao'] === 'super' || $usuario['permissao'] === 'admin') {
        return true;
    }

    // ✅ PERMISSÕES PARA USUÁRIOS NORMAIS
    $permissoes_usuario = obterPermissoesUsuario($usuario['id']);

    return in_array($permissao, $permissoes_usuario);
}

function obterPermissoesUsuario($usuario_id)
{
    $usuario = getUsuarioLogado();

    $permissoes = [];

    switch ($usuario['permissao']) {
        case 'super':
        case 'admin':
            $permissoes = [
                'admin',
                'contatos.ver',
                'contatos.criar',
                'contatos.editar',
                'contatos.excluir',
                'usuarios.ver',
                'usuarios.criar',
                'usuarios.editar',
                'usuarios.excluir'
            ];
            break;
        case 'editor':
            $permissoes = ['contatos.ver', 'contatos.criar', 'contatos.editar', 'contatos.excluir'];
            break;
        case 'user':
        default:
            $permissoes = ['contatos.ver', 'contatos.criar', 'contatos.editar', 'contatos.excluir'];
            break;
    }

    return $permissoes;
}
function verificarPermissao($permissao, $redirecionar = true)
{
    if (!temPermissao($permissao)) {
        if ($redirecionar) {
            header("Location: acesso_negado.php");
            exit;
        }
        return false;
    }
    return true;
}

// Verifica se foi solicitado logout
if (isset($_GET['logout'])) {
    fazerLogout();
}