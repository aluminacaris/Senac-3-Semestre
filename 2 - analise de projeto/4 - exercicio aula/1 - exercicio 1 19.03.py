while True:
    try:
        despesa = int(input("insira o valor da despesa dos setores:"))

        if despesa >= 10000:
            print("despesa de grande porte...")

        elif despesa >= 5000 :
            print("despesa de médio porte")

        elif despesa >= 1000:
            print("despesa de pequeno porte")

        else:
            print("despesa irrelevante.")

        reinicio = input("gostaria de usar outro valor? ")
        if reinicio == "sim":
            continue 
        else:
            print("muito obrigada por usar o app!")
            break 
    
    except ValueError:
        print("insira um valor valido animal")