from funcoes.calculos import verificar_mei
import streamlit as st

def mostrar_resultados(titulo, dados): #ex pratico mostrar_resultados("FATURAMENTO MENSAL", faturamento)
    st.write(f"\n{titulo}") #printa a string definida em titulo
    for chave, valor in dados.items(): #puxa a key e value do dicionario defiinido em dados
        st.write(f"{chave}: R${valor:.2f}") #printa a key e o value

def mostrar_indicadores(faturamento, custo, lucro):
    mostrar_resultados("FATURAMENTO MENSAL", faturamento) #vai pegar os itens (key & value) do dicionario e dispor eles na tela 
    mostrar_resultados("CUSTO MENSAL", custo) # ^
    mostrar_resultados("LUCRO MENSAL", lucro) # ^
    
    st.markdown("## RESUMO ANUAL:")
    st.write(f"Faturamento total: R${sum(faturamento.values()):.2f}") # vai somar os valores do dicionario 
    st.write(f"Custo total: R${sum(custo.values()):.2f}") # ^
    st.write(f"Lucro total: R${sum(lucro.values()):.2f}") # ^
    st.write(f"Média mensal de lucro: R${sum(lucro.values())/len(lucro):.2f}") # ^
    
    mei = verificar_mei( #puxa a função verif mei
        sum(faturamento.values())/12, #faturamento medio
        sum(faturamento.values()) #faturamento total
    )
    print("\nENQUADRAMENTO MEI:", "✅ Sim" if mei else "❌ Não") #condicional inline o nome dessa porra, se meio for true imprime sim senao nao