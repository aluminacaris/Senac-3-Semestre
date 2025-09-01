meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]

faturamento = {
    #chave = value
    #janeiro = 2 (exemplo)
}  # Dicionário para armazenar os valores

for mes in meses:
    valor = int(input(f"Insira o faturamento do mes de {mes}: "))
    faturamento[mes] = valor #faturamento[chave] = value

custo = {
    #dicionario
}

for mes in meses:
    valCusto = int(input(f"insira o custo do mes de {mes}: "))
    custo[mes] = valCusto

print("\nFaturamento Mensal!")
for mes, valor in faturamento.items():
    print(f"{mes}: R${valor}")

#somar todos os itens usa função nativa sum()
media = sum(faturamento.values()) / len(meses) #values puxa o valor das chaves de dentro do dicionario!!! dicionario{chave = valor} #len pega  a length do array, meses tem 12 valores, logo len = 12 
print(media)

print(f"\nCusto Mensal")
for mes, valCusto in custo.items():
    print(f"{mes}: R${valCusto}")


lucro = {}

print(f"\nLucro mensal")
for mes in faturamento: #percorre todosos meses em faturamento
    if mes in custo: #verifica se existem os mesmos itens em custo
        lucro[mes] = faturamento[mes] - custo[mes] # faz o calculo e adiciona o valor a lucro
        print(f"{mes}: R${lucro[mes]}") #printa o resultado

print("\nLucro total do ano")
lucroTotal = sum(lucro.values())
print(lucroTotal)

print("\nMédia de lucro do ano")
lucroMedia = sum(lucro.values()) / len(meses)
print(lucroMedia)