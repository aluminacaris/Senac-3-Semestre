from funcionario import Funcionario
from gerente import Gerente

gerente = Gerente('rodrigo', 
                  '12334556789', 
                  'gerente', 
                  20000.00,
                  '1234',
                  5
                  )

print(gerente.get_bonificacao())
print(vars(gerente))
gerente.autentica('1234')

funcionario = Funcionario('Alessandra',
                          '13256487900',
                          'analista',
                          5000.00
                          )

print(funcionario.get_bonificacao())
print(vars(funcionario))