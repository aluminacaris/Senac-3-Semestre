#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>

// Estrutura do cliente
typedef struct Cliente
{
    int id;
    char nome[100];
    char email[100];
    char telefone[20];
    struct Cliente *esquerda;
    struct Cliente *direita;
} Cliente;

// Função para criar novo nó
Cliente *novoCliente(int id, char nome[], char email[], char telefone[])
{
    Cliente *temp = (Cliente *)malloc(sizeof(Cliente));
    temp->id = id;
    strcpy(temp->nome, nome);
    strcpy(temp->email, email);
    strcpy(temp->telefone, telefone);
    temp->esquerda = temp->direita = NULL;
    return temp;
}

// Inserir cliente na árvore
Cliente *inserir(Cliente *raiz, int id, char nome[], char email[], char telefone[])
{
    if (raiz == NULL)
    {
        return novoCliente(id, nome, email, telefone);
    }

    if (id < raiz->id)
    {
        raiz->esquerda = inserir(raiz->esquerda, id, nome, email, telefone);
    }
    else if (id > raiz->id)
    {
        raiz->direita = inserir(raiz->direita, id, nome, email, telefone);
    }

    return raiz;
}

// Buscar cliente por ID
Cliente *buscar(Cliente *raiz, int id)
{
    if (raiz == NULL || raiz->id == id)
    {
        return raiz;
    }

    if (id < raiz->id)
    {
        return buscar(raiz->esquerda, id);
    }

    return buscar(raiz->direita, id);
}

// Encontrar o nó com menor valor (usado para deletar)
Cliente *menorValorNo(Cliente *no)
{
    Cliente *atual = no;
    while (atual && atual->esquerda != NULL)
    {
        atual = atual->esquerda;
    }
    return atual;
}

// Deletar cliente por ID
Cliente *deletar(Cliente *raiz, int id)
{
    if (raiz == NULL)
        return raiz;

    if (id < raiz->id)
    {
        raiz->esquerda = deletar(raiz->esquerda, id);
    }
    else if (id > raiz->id)
    {
        raiz->direita = deletar(raiz->direita, id);
    }
    else
    {
        if (raiz->esquerda == NULL)
        {
            Cliente *temp = raiz->direita;
            free(raiz);
            return temp;
        }
        else if (raiz->direita == NULL)
        {
            Cliente *temp = raiz->esquerda;
            free(raiz);
            return temp;
        }

        Cliente *temp = menorValorNo(raiz->direita);
        raiz->id = temp->id;
        strcpy(raiz->nome, temp->nome);
        strcpy(raiz->email, temp->email);
        strcpy(raiz->telefone, temp->telefone);
        raiz->direita = deletar(raiz->direita, temp->id);
    }
    return raiz;
}

// Atualizar cliente
bool atualizar(Cliente *raiz, int id, char nome[], char email[], char telefone[])
{
    Cliente *cliente = buscar(raiz, id);
    if (cliente != NULL)
    {
        strcpy(cliente->nome, nome);
        strcpy(cliente->email, email);
        strcpy(cliente->telefone, telefone);
        return true;
    }
    return false;
}

// Funções para persistência em arquivo
void salvarArvoreEmArquivo(FILE *arquivo, Cliente *raiz)
{
    if (raiz != NULL)
    {
        fprintf(arquivo, "%d,%s,%s,%s\n", raiz->id, raiz->nome, raiz->email, raiz->telefone);
        salvarArvoreEmArquivo(arquivo, raiz->esquerda);
        salvarArvoreEmArquivo(arquivo, raiz->direita);
    }
}

void salvarDados(Cliente *raiz, const char *nomeArquivo)
{
    FILE *arquivo = fopen(nomeArquivo, "w");
    if (arquivo == NULL)
    {
        printf("Erro ao abrir arquivo para escrita.\n");
        return;
    }
    salvarArvoreEmArquivo(arquivo, raiz);
    fclose(arquivo);
}

Cliente *carregarDados(Cliente *raiz, const char *nomeArquivo)
{
    FILE *arquivo = fopen(nomeArquivo, "r");
    if (arquivo == NULL)
    {
        return raiz;
    }

    int id;
    char nome[100], email[100], telefone[20];

    while (fscanf(arquivo, "%d,%99[^,],%99[^,],%19[^\n]\n", &id, nome, email, telefone) == 4)
    {
        raiz = inserir(raiz, id, nome, email, telefone);
    }

    fclose(arquivo);
    return raiz;
}

// Função para exibir clientes em ordem
void emOrdem(Cliente *raiz)
{
    if (raiz != NULL)
    {
        emOrdem(raiz->esquerda);
        printf("ID: %d, Nome: %s, Email: %s, Telefone: %s\n",
               raiz->id, raiz->nome, raiz->email, raiz->telefone);
        emOrdem(raiz->direita);
    }
}

// Adicionar estas funções no arquivo arvore_clientes.c (parte principal)

// Função para listar clientes (usada pela interface Python)
void listarClientes(Cliente *raiz, FILE *saida)
{
    if (raiz != NULL)
    {
        listarClientes(raiz->esquerda, saida);
        fprintf(saida, "%d,%s,%s,%s\n", raiz->id, raiz->nome, raiz->email, raiz->telefone);
        listarClientes(raiz->direita, saida);
    }
}

// Função principal modificada para aceitar comandos
int main(int argc, char *argv[])
{
    Cliente *raiz = NULL;
    const char *nomeArquivo = "clientes.dat";

    // Carregar dados existentes
    raiz = carregarDados(raiz, nomeArquivo);

    if (argc > 1)
    {
        char *comando = argv[1];

        if (strcmp(comando, "inserir") == 0 && argc == 6)
        {
            int id = atoi(argv[2]);
            raiz = inserir(raiz, id, argv[3], argv[4], argv[5]);
            salvarDados(raiz, nomeArquivo);
        }
        else if (strcmp(comando, "buscar") == 0 && argc == 3)
        {
            int id = atoi(argv[2]);
            Cliente *encontrado = buscar(raiz, id);
            if (encontrado != NULL)
            {
                printf("%d,%s,%s,%s", encontrado->id, encontrado->nome, encontrado->email, encontrado->telefone);
            }
        }
        else if (strcmp(comando, "atualizar") == 0 && argc == 6)
        {
            int id = atoi(argv[2]);
            if (atualizar(raiz, id, argv[3], argv[4], argv[5]))
            {
                salvarDados(raiz, nomeArquivo);
                printf("Atualizado com sucesso");
            }
            else
            {
                printf("Cliente não encontrado");
            }
        }
        else if (strcmp(comando, "remover") == 0 && argc == 3)
        {
            int id = atoi(argv[2]);
            raiz = deletar(raiz, id);
            salvarDados(raiz, nomeArquivo);
            printf("Removido com sucesso");
        }
        else if (strcmp(comando, "listar") == 0)
        {
            listarClientes(raiz, stdout);
        }
        else
        {
            printf("Comando inválido ou parâmetros incorretos");
        }
    }

    return 0;
}