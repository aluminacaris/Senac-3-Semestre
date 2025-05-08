from usuario import Usuario 

class Professor(Usuario): #herda de user
    def __init__(self, nome, endereco_completo, contato, departamento, titulacao): 
        super().__init__(nome, endereco_completo, contato)
        self._departamento = departamento
        self._titulacao = titulacao
