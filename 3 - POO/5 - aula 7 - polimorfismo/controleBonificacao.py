class controleBonificacao:
    def __init__(self, total_bonificacoes=0):
        self._total_bonificacoes = total_bonificacoes

    def registra(self, obj):
        # resolver erro código com o if, 
        if(hasattr(obj, 'get_bonificacao')):
            self._total_bonificacoes += obj.get_bonificacao()
        else:
            print("instancia de {} não implementa o método get_bonificacao()".format(self.__class__.__name__))

    @property
    def total_bonificacoes(self):
        return self._total_bonificacoes
    
    