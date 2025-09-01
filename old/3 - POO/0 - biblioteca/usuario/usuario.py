class Usuario: #classe base, superclasse
    def __init__(self, nome, endereco_completo, contato):
        self._nome = nome
        self._endereço = endereco_completo
        self._contato = contato

    def emprestimo(self):
        self
