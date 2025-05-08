class Empresa:
    def __init__(self, nome, CNPJ):
        self._nome = nome
        self._CNPJ = CNPJ

    @property
    def CNPJ(self):
        return self._CNPJ
    
    @CNPJ.setter
    def CNPJ(self, CNPJ):
        self._CNPJ = CNPJ

