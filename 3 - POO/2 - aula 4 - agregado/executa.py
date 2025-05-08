from conta import Conta # instanciar classe conta
from cliente import Cliente

c1 = Cliente('Rodrigo', 'Viecheneski', '04547726877')
c2 = Cliente('pedro', 'godinho', '0000000000')

m1 = Conta('123-1', c1, 120.0, 1000.0)
m2 = Conta('123-2', c2, 220.0, 1000.0)

print(m2.titular.nome)
print(m2.titular.sobrenome)
print(m2.titular.cpf)

print(m2.__dict__)
print(m2.titular.__dict__)

# print(minhaConta.titular.sobrenome)
# print(minhaConta.titular.cpf)

# print(minhaConta.__dict__)
# print(minhaConta.titular.__dict__)