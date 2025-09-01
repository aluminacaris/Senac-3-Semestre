class Obra:
    def __init__(self, titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, status):
        self._titulo = titulo
        self._ano_public = ano_public
        self._edicao = edicao
        self._num_paginas = num_paginas
        self._lingua = lingua
        self._midia = midia
        self._autor = autor
        self._nacio_autor = nacio_autor
        self._status = status

    def disponivel(self):
        if (self._status == 'disponivel'):
            print("Obra disponivel para emprestimo")
            return True
        else:
            print("Obra indisponivel para empréstimo")
            return False
        
   