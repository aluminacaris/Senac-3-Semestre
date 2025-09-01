from obras import Obra

class Per_informativo(Obra):
    def __init__(self, titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, ISSN, status):
        super().__init__(titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, status)
        self.ISSN = ISSN

    def disponivel(self):
        return super().disponivel()
