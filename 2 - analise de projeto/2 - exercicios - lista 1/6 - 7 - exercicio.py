print("\n")

print("=============================")
print("--- !bolo menos calórico! ---")
print("=============================")

xicara = int(input("Quantas xícaras de farinha vai usar? "))
xicaraMl = int(input("Quantos ml tem cada xícara? "))
xicaraMlTotal = xicara * xicaraMl

leiteCondensado = int(input("Quantas latas de leite condensado vai usar? "))
leiteCondensadoMl = int(input("Quantos ml tem cada lata? "))
leiteCondensadoTotal = leiteCondensado * leiteCondensadoMl

leiteCondensadoReduzido = leiteCondensadoTotal * 0.80

ovo = int(input("Quantos ovos vai usar? "))
ovoMlUni = int(input("Quantos ml tem cada ovo? "))
ovoMlTotal = ovoMlUni * ovo

somaIngredientes = xicaraMlTotal + leiteCondensadoReduzido + ovoMlTotal

aluguel = float(input("Digite o valor do aluguel: "))
energia = float(input("Digite o valor da energia elétrica: "))
internet = float(input("Digite o valor da internet: "))
agua = float(input("Digite o valor da água: "))

estoque_leite = float(input("Digite o valor unitário da lata de leite condensado: ")) * leiteCondensado
estoque_ovo = float(input("Digite o valor unitário dos ovos: ")) * ovo
estoque_farinha = float(input("Digite o valor unitário da xícara de farinha de trigo: ")) * xicara
gas = float(input("Digite o valor do gás: "))
embalagem = float(input("Digite o valor da embalagem: "))

desp_cozinha = float(input("Digite o valor das despesas do setor da cozinha: "))
desp_vendas = float(input("Digite o valor das despesas do setor de vendas: "))
desp_admin = float(input("Digite o valor das despesas do setor administrativo: "))
anuidade_dominio = float(input("Digite o valor da anuidade de domínio: "))
mensalidade_mei = float(input("Digite o valor da mensalidade do MEI: "))
transporte = float(input("Digite o valor do transporte: "))

icms = float(input("Digite o valor do ICMS: "))

custo_produto = (estoque_leite + estoque_ovo + estoque_farinha + gas + embalagem)

# Cálculo do Custo Total de Aquisição (CTA)
cta = custo_produto + icms + transporte + desp_admin

print("\n")
print("ATENÇÃO: Esta é a versão menos calórica do bolo, com 20% menos leite condensado!\n")
print(f"A soma dos ml dos ingredientes é {somaIngredientes:.2f}ml\n")
print(f"O Custo Total de Aquisição do Produto/Serviço (CTA) é R$ {cta:.2f}\n")

dv = float(input("Digite a porcentagem de despesas variáveis (%): "))
df = float(input("Digite a porcentagem de despesas fixas (%): "))
ml = float(input("Digite a margem de lucro desejada (%): "))

markup = 100 / (100 - (dv + df + ml))

print("\n")
print("ATENÇÃO: Esta é a versão menos calórica do bolo, com 20% menos leite condensado!\n")
print(f"A soma dos ml dos ingredientes é {somaIngredientes:.2f}ml\n")
print(f"O Custo Total de Aquisição do Produto/Serviço (CTA) é R$ {cta:.2f}\n")
print(f"O Markup calculado é {markup:.2f}\n")
