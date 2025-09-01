#include <iostream>
#include <string>

using namespace std;

struct Usuario {
    int id;
    string nome;
    string login;
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
        cout << "Informe ID: ";
        cin >> novoUsuario->id;
        cout << "Informe o nome: ";
        cin >> novoUsuario->nome;
        cout << "Informe o login: ";
        cin >> novoUsuario->login;

        novoUsuario->prox = NULL;
    
     
        if (!head) {
            head = novoUsuario;
            return;
        }

        Usuario* temp = head;
        while (temp->prox) {
            temp = temp->prox;
        }

        temp->prox = novoUsuario;
    }

    void exibirUsuarios() {
        if (!head) {
            cout << "Nenhum usuário cadastrado." << endl;
            return;
        }

        Usuario* temp = head;
        while (temp) {
            cout << "ID: " << temp->id << endl;
            cout << "Nome: " << temp->nome << endl;
            cout << "Login: " << temp->login << endl;
            cout << endl;
            temp = temp->prox;
        }
    }

    void buscarPorID(int id) {
        Usuario* temp = head;
        while (temp) {
            if (temp->id == id) {
                cout << "Usuário encontrado:\n";
                cout << "ID: " << temp->id << endl;
                cout << "Nome: " << temp->nome << endl;
                cout << "Login: " << temp->login << endl;
                return;
            }
            temp = temp->prox;
        }
        cout << "Usuário com ID " << id << " não encontrado.\n";
    }

    void removerPorID(int id) {
        if (!head) {
            cout << "Lista vazia." << endl;
            return;
        }

        if (head->id == id) {
            Usuario* temp = head;
            head = head->prox;
            delete temp;
            cout << "Usuário removido." << endl;
            return;
        }

        Usuario* atual = head;
        Usuario* anterior = NULL;

        while (atual && atual->id != id) {
            anterior = atual;
            atual = atual->prox;
        }

        if (!atual) {
            cout << "Usuário com ID " << id << " não encontrado." << endl;
            return;
        }

        anterior->prox = atual->prox;
        delete atual;
        cout << "Usuário removido." << endl;
    }
};

int main() {
    ListaEncadeada lista;
    int opcao;

    do {
        cout << "\nMenu:\n";
        cout << "1 - Cadastrar usuário\n";
        cout << "2 - Listar usuários\n";
        cout << "3 - Buscar usuário por ID\n";
        cout << "4 - Remover usuário por ID\n";
        cout << "0 - Sair\n";
        cout << "Escolha: ";
        cin >> opcao;

        switch(opcao) {
            case 1:
                lista.inserirUsuarioFinal();
                break;

            case 2:
                lista.exibirUsuarios();
                break;

            case 3: {
                int id;
                cout << "Informe o ID a buscar: ";
                cin >> id;
                lista.buscarPorID(id);
                break;
            }

            case 4: {
                int id;
                cout << "Informe o ID a remover: ";
                cin >> id;
                lista.removerPorID(id);
                break;
            }

            case 0:
                cout << "Encerrando..." << endl;
                break;

            default:
                cout << "Opção inválida. Tente novamente.\n";
                break;
        }

    } while (opcao != 0);

    return 0;
}