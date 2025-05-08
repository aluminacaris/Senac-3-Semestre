while True:
    try:
        value = int(input("digite o valor desejado:"))
        classify = int(input("insira a classificação do valor, 1 para ativo e 2 para passivo:"))

        if classify == 1:
            if value > 0:
                print(f"Débito no ativo: R${value} registrado")
            else:
                print(f"Crédito no ativo: R${value} regitrado! ")

        elif classify == 2:
            if value > 0:
                print(f"Crédito no passivo: R${value} registrado")
            else:
                print(f"Débito no passivo: R${value} registrado! ")

        else:
            print("valor invalido, tente novamente.")
            continue

        reinicio = input("gostaria de adicionar outro valor?").strip().lower()
        if reinicio == "sim":
            continue
        else:
            print("muito obrigada por usar o sistema! :)")
            break

    except ValueError:
        print("Entrada inválida! Digite apenas números inteiros.")
