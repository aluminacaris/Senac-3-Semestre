import math #pra poder usar o valor de pi

# Considere:
# Leite condensado (395g ≈ 306mL)
# Ovos (4 ovos ≈ 200mL)
# Farinha de trigo (120g ≈ 132mL)

#letra a
# xicara = 132
# leiteCondensado = 306
# ovo = 200

print("\n")

print("=============================")
print("--- exercicio (4) do bolo ---")
print("=============================")

xicara = int(input("quantas xicaras de farinha vai usar? "))
xicaraMl = int(input("quantos ml tem cada xicara? "))
xicaraMlTotal = xicara * xicaraMl

leiteCondensado = int(input("quantas latas de leite condensado vai usar?"))
leiteCondensadoMl = int(input("quantos ml tem cada lata?"))
leiConTotal = leiteCondensado * leiteCondensadoMl

ovo = int(input("quantos ovos vai usar? "))
ovoMlUni = int(input("quantos ml tem cada ovo?"))
ovoMlTotal = ovoMlUni * ovo

somaIngredientes = xicaraMlTotal + leiConTotal + ovoMlTotal

print("\n")
print(f"a soma dos ml dos ingredientes é {somaIngredientes}ml\n")

# letra b

# considere
# Média: 20 cm (comprimento) x 15 cm (largura) x 5 cm (altura)

print("insira os dados da sua forma para descobrirmos o volume (numeros inteiros sem cm)")
comprimento = int(input("qual o comprimento? "))
largura = int(input("qual a largura? "))
altura = int(input("qual a altura? "))

print(f"os valores são:\n{comprimento}cm\n{largura}cm\n{altura}cm")

volume = comprimento * largura * altura

print(f"o volume da forma é {volume}cm³.\n")

# pré letra c

if(somaIngredientes <= volume):
    print("a receita cabe na forma!\n")
else:
    print("a receita não cabe na forma...\n")

# letra c

areaPapel = comprimento * largura 
print(f"A área do papel necessário para untar a forma retangular é {areaPapel} cm².\n")

# letra d
# considere 15 altura 10 raio

print("vamos descobrir esses dados para uma forma redonda!")
alturaCilindro = float(input("Qual a altura da forma? "))
raio = float(input("Qual o raio da forma? "))

print(f"a altura é {alturaCilindro}cm")
print(f"o raio é {raio}cm\n")

volumeCilindro = math.pi * (raio ** 2) * alturaCilindro # (var ** 2) faz potencia!!! // math.pi puxa o valor de pi, precisa importar math no codigo

print(f"O volume do cilindro é {volumeCilindro:.2f} cm³.\n") #:.2f é formataçã0 de string pra mostrar uma qtd especifica de digitos decimais !

if(somaIngredientes <= volumeCilindro):
    print("a receita cabe na forma!\n")
else:
    print("a receita não cabe na forma...\n")

# letra e

# Calcular a área da base
areaBase = math.pi * (raio ** 2)

# Calcular a área lateral
areaLateral = 2 * math.pi * raio * altura

# Calcular a área total
areaTotal = areaBase + areaLateral

print(f"a area da base da forma é {areaBase:.2f}cm")
print(f"a area lateral da forma é {areaLateral:.2f}cm\n")

print(f"A área total do papel necessário para untar a forma redonda é {areaTotal:.2f} cm².\n")

