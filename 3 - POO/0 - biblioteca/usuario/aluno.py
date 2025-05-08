from usuario.usuario import Usuario 

class Aluno(Usuario): #herda de user
    def __init__(self, nome, endereco_completo, contato, matricula, curso):
        super().__init__(nome, endereco_completo, contato)
        self.__matricula = matricula
        self._curso = curso

    @property
    def matricula(self):
        return self._matricula
    
    @matricula.setter
    def matricula(self, matricula):
        self._matricula = matricula

    @property
    def curso(self):
        return self._curso
    
    @curso.setter
    def curso(self, curso):
        self._curso = curso