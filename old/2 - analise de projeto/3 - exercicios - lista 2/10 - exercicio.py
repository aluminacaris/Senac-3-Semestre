while True:
    try:
        value = int(input("digite o valor desejado: "))

        while True:
            try:
                Descricao = int(input("insira a descrição do valor: \nbem – 1\ndireito – 2\nobrigação com terceiro – 3\nobrigação com sócio – 4\nDigite o numero: "))
                if 1 <= Descricao <= 4:
                    break
                else:
                    print("\nentrada invalida, insira um valor entre 1 e 4!\n")
                
            except ValueError:
                print("\nEntrada inválida! Digite apenas números inteiros.\n")
        
        while True:
            try:    
                classify = int(input("\ninsira a classificação do valor\n1 - ativo\n2 - passivo \n3 - patrimônio liquido\nDigite o numero: "))
                if 1 <= classify <= 3:
                    break
                else:
                    print("\nentrada invalida, insira um valor entre 1 e 31!")

            except ValueError:
                print("\nEntrada inválida! Digite apenas números inteiros.\n")

        if classify == 1: #ativo
            if Descricao == 1:
                print(f"\ncadastro de ativo do tipo ‘bem’ realizado com sucesso, valor: R${value}") 
            elif (Descricao != 1 or Descricao == 2):
                print(f"\ncadastro de ativo do tipo ‘direito’ realizado com sucesso, valor: R${value}") 

        if classify == 2: #passivo
            if Descricao == 3:
                print(f"\ncadastro de passivo do tipo ‘obrigações com terceiros’ realizado com sucesso, valor: R${value}")
            elif Descricao != 3 or Descricao == 4:
                print(f"\ncadastro de passivo do tipo ‘obrigações com socios’ realizado com sucesso, valor: R${value}")
                
        if classify == 3:
            print("\né definitivamente um patrimonio liquido")
            
        reinicio = input("\ngostaria de adicionar outro valor? ").strip().lower()
        if reinicio == "sim":
            print("\n")
            continue
        else:
            print("\nmuito obrigada por usar o sistema! :)")
            break

    except ValueError:
        print("\nEntrada inválida! Digite apenas números inteiros.")
#só pra dar 50 linha