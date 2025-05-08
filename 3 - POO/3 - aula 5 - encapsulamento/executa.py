from conta import Conta # instanciar classe conta

conta1 = Conta(200.00)
conta2 = Conta(300.00)
conta3 = Conta(-100.00)


# print(conta1.saldo)

# conta1 = Conta(-1000.00)
conta1.saldo = 300.00

print(conta1.saldo)