while True:
    try:
        despesas = [] #o append insere os valores do input aqui!!!

        for i in range(5): #gera uma sequência de números
            despesa = int(input(f"Insira o valor da despesa do setor {i + 1}: "))
            despesas.append(despesa) #adicionar um elemento ao final de uma lista. 

        print("\nClassificação das despesas por setor:")
        for i, despesa in enumerate(despesas): #enumerate, da uma posição pra cada item dentro da lista, 1 2 3 e etc
            if despesa >= 10000:
                classificacao = "despesa de grande porte"
            elif despesa >= 5000:
                classificacao = "despesa de médio porte"
            elif despesa >= 1000:
                classificacao = "despesa de pequeno porte"
            else:
                classificacao = "despesa irrelevante"
            print(f"Setor {i + 1}: R$ {despesa} - {classificacao}")

        reinicio = input("\nGostaria de classificar outro conjunto de setores? (sim/não): ").strip().lower() #.strip() é usado para remover espaços em branco da entrada do usuário, garantindo que a comparação com "sim" funcione corretamente, e o lower deixa todos os chars minusculos
        if reinicio != "sim":
            print("Muito obrigada por usar o app!")
            break

    except ValueError:
        print("Por favor, insira um valor válido.")