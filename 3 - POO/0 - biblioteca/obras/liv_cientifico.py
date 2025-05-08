from obras import Obra

class Liv_cientifico(Obra):
    def __init__(self, titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, ISBN, status):
        super().__init__(titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, status)
        self.ISBN = ISBN
        
    def disponivel(self):
        return super().disponivel()