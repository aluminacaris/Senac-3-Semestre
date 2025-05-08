print("\n")

print("=============================")
print("--- !bolo menos calorico! ---")
print("=============================")

xicara = int(input("quantas xicaras de farinha vai usar? "))
xicaraMl = int(input("quantos ml tem cada xicara? "))
xicaraMlTotal = xicara * xicaraMl

leiteCondensado = int(input("quantas latas de leite condensado vai usar?"))
leiteCondensadoMl = int(input("quantos ml tem cada lata?"))
leiConTotal = leiteCondensado * leiteCondensadoMl

leiteCondensadoReduzido = leiConTotal * 0.80

ovo = int(input("quantos ovos vai usar? "))
ovoMlUni = int(input("quantos ml tem cada ovo?"))
ovoMlTotal = ovoMlUni * ovo

somaIngredientes = xicaraMlTotal + leiteCondensadoReduzido + ovoMlTotal

print("\n")
print("ATENÇÃO: Esta é a versão menos calórica do bolo, com 20% menos leite condensado!\n")
print(f"A soma dos ml dos ingredientes é {somaIngredientes:.2f}ml\n")

encomendas = [350.00, 160.00, 200.00, 150.00, 230.00, 280.00, 500.00, 8000.00, 130.00, 200.00] #é uma list, vulgo Array
valor_medio_encomenda = sum(encomendas) / len(encomendas)
#sum(encomendas): Calcula a soma total dos valores das encomendas.
#len(encomendas): Conta quantos elementos existem na lista (número total de encomendas).