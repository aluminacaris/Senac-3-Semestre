from obras.obras import Obra

class LivEntretenimento(Obra):
    def __init__(self, titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, ISBN, status):
        super().__init__(titulo, ano_public, edicao, num_paginas, lingua, midia, autor, nacio_autor, status)
        self.ISBN = ISBN
    
    def disponivel(self):
        return super().disponivel()    