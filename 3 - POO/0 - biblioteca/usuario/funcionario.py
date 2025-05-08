from usuario import Usuario

class Funcionario(Usuario): #herda de user
    def __init__(self, nome, endereco_completo, contato, setor, cargo):
        super().__init__(nome, endereco_completo, contato)
        self._setor = setor
        self._cargo = cargo 