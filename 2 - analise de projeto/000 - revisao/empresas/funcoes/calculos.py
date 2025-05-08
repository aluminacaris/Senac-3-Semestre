import streamlit as st

def calcular_lucro_mensal(faturamento, custo):
    """Calcula lucro mensal mantendo o estilo original mas mais robusta"""
    try:
        return {
            mes: float(faturamento[mes]) - float(custo[mes])
            for mes in set(faturamento) & set(custo)  # Intersecção de meses
            if (faturamento.get(mes) is not None and 
               custo.get(mes) is not None)
        }
    except (TypeError, ValueError) as e:
        st.error(f"Erro ao calcular lucro: {str(e)}")
        return {}

def calcular_media(valores): #recebe um dict de valores
    return sum(valores.values()) / len(valores)     if valores else 0 #verifica se ta vazio, se tiver retorna 0 (evita div por 0) sum() soma os valroes doarray, len() pega o valor da quantidade de itens dentro do array, logo divide a soma dos valores pela quantidade de valores e retorna o resultado

def verificar_mei(faturamento_medio, faturamento_total):
    return faturamento_medio <= 6750 and faturamento_total <= 150000 #condicional se fat_medio for menorigual a 6750 é true e se fat_total for menorigual a 150000 é true

def bubblesort_cresc(lista):
    n = len(lista)
    for i in range(n):
        for j in range(0, n - i - 1):
            if lista[j] > lista[j + 1]:
                lista[j], lista[j + 1] = lista[j+1], lista[j]
    return lista

def bubblesort_decresc(lista):
    n = len(lista)
    for i in range(n):
        for j in range(0, n - i - 1):
            if lista[j] < lista[j + 1]:
                lista[j], lista[j + 1] = lista[j+1], lista[j]
    return lista