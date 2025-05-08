

class Pessoa:
    def __init__(self, nome, idade):
        self.nome = nome
        self.idade = idade

    def __str__(self):
        return f"{self.nome}, {self.idade} anos"

p = Pessoa("Alice", 25)
print(p)  # Saída: Alice, 25 anos


class Numero:
    def __init__(self, valor):
        self.valor = valor

    def __add__(self, outro):
        return Numero(self.valor + outro.valor)

    def __str__(self):
        return str(self.valor)  

n1 = Numero(10)
n2 = Numero(5)
print(n1 + n2)  # Saída: 15



class Produto:
    def __init__(self, preco):
        self.preco = preco

    def __lt__(self, outro):
        return self.preco < outro.preco

p1 = Produto(50)
p2 = Produto(100)

print(p1 < p2)  # Saída: True



class ListaPersonalizada:
    def __init__(self, itens):
        self.itens = itens

    def __len__(self):
        return len(self.itens)

    def __getitem__(self, index):
        return self.itens[index]

lista = ListaPersonalizada([1, 2, 3, 4])
print(len(lista))  # Saída: 4
print(lista[2])    # Saída: 3



class Somador:
    def __call__(self, a, b):
        return a + b

soma = Somador()
print(soma(3, 5))  # Saída: 8
