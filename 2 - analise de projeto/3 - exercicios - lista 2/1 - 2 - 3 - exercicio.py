while True:  # while(1)
    try:
        classific = int(input("Insira o ID (1 para ativo, 2 para passivo): "))
        
        if classific == 1:
            print("Cadastro de usuário ativo bem-sucedido!")
            reinicio = input("gostaria de cadastrar novamente? ")
            if reinicio == "sim":
                continue 
            else:
                print("muito obrigada pelo cadastro!")
                break 

        elif classific == 2:
            print("Cadastro de usuário passivo bem-sucedido!")
            reinicio = input("gostaria de cadastrar novamente? ")
            if reinicio == "sim":
                continue 
            else:
                print("muito obrigada pelo cadastro!")
                break 

        elif classific == 3:
            print("Cadastro de patrimonio liquido bem-sucedido!")
            reinicio = input("gostaria de cadastrar novamente? ")
            if reinicio == "sim":
                continue 
            else:
                print("muito obrigada pelo cadastro!")
                break 

        else:
            print("ID desconhecido. Favor inserir um valor válido (1 ou 2).")

    except ValueError:
        print("Entrada inválida! Digite apenas números inteiros.")
