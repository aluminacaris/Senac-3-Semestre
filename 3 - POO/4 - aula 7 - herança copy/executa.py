from funcionario import Funcionario
from gerente import Gerente
from controleBonificacao import controleBonificacao
# polimorfismo é a capacidade de um objeto poder referenciado de varias formas
if __name__ == '__main__':

    funcionario = Funcionario('Raphael', '89723143272', 'vendedor', 2000.00)
    print("bonificação funcionário: {}".format(funcionario.get_bonificacao()))

    gerente = Gerente('Treicy', '12345678900', 'administrativo', 5000.00, '1234', 0)
    print("bonificação funcionário: {}".format(gerente.get_bonificacao()))

    controle = controleBonificacao( )
    controle.registra(funcionario)
    controle.registra(gerente)

    print("total: {}".format(controle.total_bonificacoes))