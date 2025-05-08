import streamlit as st

# nome = input("insira seunome")
# sobrenome = input("insira seu sobrenome")
# DataNasc = input("insira sua data de nascimento no formato DD/MM/YYYY")
# EstadoCivil = input("insira seu estado civil")
# sexo = input("insira seu sexo")
salario = int(input("insira seu salario: "))

# if funcionario._salario > 2,500: recebe aumento
# else nao
aumento = 0
if salario <= 2500:
    while True:
            if aumento < 500:
                salario += 100
                aumento += 100
                continue
        
print((f"salario com aumento: {salario}"))
