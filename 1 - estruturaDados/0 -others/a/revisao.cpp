#include <iostream>
#include <string>

using namespace std;

struct Usuario
{
    int id;
    string nome;
    string login;
    Usuario *prox;
};

class listaEncadeada{
public:
    Usuario *head;
    listaEncadeada(){
        head = NULL;
    }
        
    void inserirUsuarioFinal(){
        Usuario *novoUsuario = new Usuario();
        cout << "insira o id: " << endl;
        cin >> novoUsuario->id;
        cout << "insira o nome: " << endl;
        cin >> novoUsuario->nome;
        cout << "insira o login" << endl;
        cin >> novoUsuario->login;

        novoUsuario->prox = NULL;

        if (!head){
            head = novoUsuario;
            return;
        }

        Usuario *temp = NULL;
        while(temp->prox){
            temp = temp->prox;
        }

        temp->prox = novoUsuario;
    }

    void listarUsuarios(){
        Usuario *temp = NULL;
        temp = head;
        while(temp){
            cout << temp -> id << endl;
            cout << temp -> nome << endl;
            cout << temp -> login << endl;
            temp = temp->prox;
        }
    }

    void atualizarUsuario(){
        int identificador;
        cout << "informe o id: " << endl;
        cin >> identificador;      
        Usuario *temp = NULL;
        temp = head;

        while(temp){
            if(temp->id == identificador){
                cout << "informe o novo ID" << endl;
                cin >> temp->id;
                cout << "informe o novo nome: " << endl;
                cin >> temp->nome;
                cout << "insira o novo login: " << endl;
                cin >> temp->login;
            }
            temp = temp->prox;
        }
    }

    void deletarUsuario(){
        int identificador;
        cout << "informe o id: " << endl;
        cin >> identificador;        
        Usuario *temp = NULL;
        temp = head;
        Usuario *tempAnterior = NULL;
        tempAnterior = head;
        while(temp){
            tempAnterior = temp;
            if(tempAnterior->id == identificador){
                tempAnterior = temp -> prox;
                temp = NULL;
                temp = tempAnterior;
            }
            temp = temp -> prox;
        }
    }
};

int main(){
    listaEncadeada lista;
    int opcao;

    while(true){
        cout << "informe a opcao" << endl;
        cout << "1 - cadastrto" << endl;
        cout << "2 - exibir" << endl;
        cout << "3 - atualizar" << endl;
        cout << "4 - deletar" << endl;
        cout << "0 - sair" << endl;
        cin >> opcao;

        switch (opcao)
        {
        case 1: lista.inserirUsuarioFinal();
        break;

        case 2: lista.listarUsuarios();
        break;

        case 3: lista.atualizarUsuario();
        break;

        case 4: lista.deletarUsuario();
        break;

        case 0: cout << "saidooo" << endl;
        return;
    }
}