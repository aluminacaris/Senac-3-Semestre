#include <iostream>
#include <string>

using namespace std;

struct Usuario
{
    // primeira parte = DATA
    int id;
    string nome;
    string login;
    string email;

    // segunda parte NEXT
    Usuario *prox;
};

class ListaEncadeada
{
public:
    Usuario *head;
    ListaEncadeada()
    {
        head = NULL;
    }

    Usuario *criarUsuario()
    {
        // criação de um objeto do struct Usuario
        Usuario *usuario = new Usuario();
        cout << "informe ID" << endl;
        cin >> usuario->id;

        cout << "informe o nome" << endl;
        cin >> usuario->nome;

        cout << "informe email" << endl;
        cin >> usuario->email;

        return usuario;
    }

    void inserirUsuarioFinal()
    {
        // verificar se a lista existe
        if (head == NULL)
        {
            Usuario *u = criarUsuario();
            head->prox = u;
        }
    }
};

int main() {
    ListaEncadeada lista;
    lista.inserirUsuarioFinal();
    

};