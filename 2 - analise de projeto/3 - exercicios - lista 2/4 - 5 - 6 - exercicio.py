#exercicio 6

while True:
    try:
        descricao = int(input("Digite o desejado (bem – 1, direito – 2, obrigação com terceiro – 3, obrigação com sócio – 4): "))

        if descricao == 1 or descricao == 2:
            print("Cadastro de ativo realizado com sucesso.")
            reinicio = input("gostaria de cadastrar novamente? ")
            if reinicio == "sim":
                continue 
            else:
                print("muito obrigada pelo cadastro!")
                break 

        elif descricao == 3:
            print("Cadastro de passivo realizado com sucesso.")
            reinicio = input("gostaria de cadastrar novamente? ")
            if reinicio == "sim":
                continue 
            else:
                print("muito obrigada pelo cadastro!")
                break 

        elif descricao == 4:
            print("Cadastro de patrimônio líquido realizado com sucesso.")
            reinicio = input("gostaria de cadastrar novamente? ")
            if reinicio == "sim":
                continue 
            else:
                print("muito obrigada pelo cadastro!")
                break 

    except ValueError:
        print("Entrada inválida! Digite apenas números inteiros.")


        # exercicio 5
#         if descricao == 1 or descricao == 2:
#           print("Cadastro de ativo realizado com sucesso.")

#         if descricao == 3:
#             print("Cadastro de passivo realizado com sucesso.")
    
#         if descricao == 4:
#             print("Cadastro de patrimônio líquido realizado com sucesso.")