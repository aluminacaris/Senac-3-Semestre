

#include <iostream>
#include <string>

using namespace std;

struct Usuario {
    // primeira parte = DATA
    int id;
    string nome;
    string login;
    string email;
    // segunda parte NEXT
    Usuario *prox;
};

class ListaEncadeada {
public:
    Usuario* head;
    ListaEncadeada() {
        head = NULL;
    }


    void inserirUsuarioFinal() {
        Usuario* novoUsuario = new Usuario();
        cout << "Informe ID" << endl;
        cin >> novoUsuario->id;
        cout << "Informe o nome" << endl;
        cin >> novoUsuario->nome;
        // é muito importante que na criação de um nodo o apontamento para o próximo seja nulo.
        novoUsuario->prox=NULL;

        // verificar se a lista não existe
        if (!head) {
            // se a lista não existe, cria-se a lista
            // a criação da lista consiste em, basicamente, criar um apontamento para o head
            head = novoUsuario;
            return;
        }
        Usuario* temp = NULL;
        temp = head;
        while (temp->prox) {
            temp = temp->prox;
            // quando findar este while o ponteiro temp terá chegado ao 
            // último nodo existente até então nesta lista
        }
        temp->prox = novoUsuario;
        // fora do while, teremos acesso ao ponteiro do último nodo da lista
        //temp->prox = usuario;
    }

    void exibirUsuarios() {
        Usuario* temp = head;
        while (temp) {
            cout << "ID: " << temp->id << endl;
            cout << "Nome: " << temp->nome << endl;
            temp = temp->prox;

        }
    }

};  


int main()
{
    ListaEncadeada lista;
    for (int i = 0; i < 2; i++)
    {
        lista.inserirUsuarioFinal();
    }
    lista.exibirUsuarios();
}
