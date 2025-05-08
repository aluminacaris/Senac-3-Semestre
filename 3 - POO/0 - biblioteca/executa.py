from obras.entretenimento import LivEntretenimento
from usuario.aluno import Aluno


aluno1 = Aluno('pedro',
               'rua dorival banana 123',
               '42940028922',
               '908420',
               'ciencia da computação'
               )

livro1 = LivEntretenimento('Historia Sem fim',
                            '1979',
                            'limitada 2025',
                            '432',
                            'PT-BR',
                            'fisica',
                            'Michael Ende',
                            'Alemão',
                            '978-8532502469',
                            'disponivel'
                            )

print(vars(livro1))

