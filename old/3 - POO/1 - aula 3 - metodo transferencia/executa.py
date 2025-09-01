from conta import Conta # instanciar classe conta

c1 = Conta('123-1', 'Rodrigo', 120.0, 1000.0)
c2 = Conta('123-2', 'gilso', 10.0, 1000.0)
c3 = Conta('123-1', 'pedro', 120.0, 1000.0)

print(c1.saldo, "rodrigo")

c2.depositar(300.0)
print(c2.saldo, "gilso")

c2.transferencia(c1, 105.0)

print(c1.saldo, "rodrigo")
print(c2.saldo, "gilso")
