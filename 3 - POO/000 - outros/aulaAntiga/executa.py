from conta import Conta # instanciar classe conta

c1 = Conta('123-4', 'Rodrigo', 120.0, 1000.0)
c2 = Conta('369-2', 'pedro', 120.0, 1000.0)
c3 = Conta('369-3', 'rafaelle', 120.0, 1000.0)

print(c2.saldo)
c2.depositar(0.50)
print(c2.saldo)

print(c1.saldo)
c1.depositar(0.50)
print(c1.saldo)

if(c1 == c3):
    print("contas são iguais!")
else:
    print("contas são diferentes...")

# from pessoa import Pessoa 

# x = Pessoa("Rafaella", 37, 1000.0)
# x.exibir()