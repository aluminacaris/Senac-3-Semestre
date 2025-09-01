import streamlit as st
import time
from itertools import count

# Gerador de IDs únicos
counter = count()

def obter_nome_qtd_empresa():
    nome_empresa = st.text_input("Qual o nome da sua empresa?").strip()
    
    if not nome_empresa:
        st.warning("Por favor, informe o nome da empresa")
        st.stop()
        
    qtd_filiais = st.number_input(
        "Quantas filiais tem?",
        min_value=0,
        max_value=10,  # Mais legível com separadores
        step=1,
        value=None,
        format="%d",
        placeholder="por ex: 3",
    )
    
    if qtd_filiais is None:
        st.warning("Por favor, informe a quantidade de filiais")
        st.stop()
    
    return nome_empresa, qtd_filiais



def obter_dados_por_filial(qtd_filiais, meses, tipo_dado):
    dados_filiais = {}
    tabs = st.tabs([f"Filial {i+1}" for i in range(qtd_filiais)])
    
    for i, tab in enumerate(tabs, start=1):
        with tab:
            if tipo_dado == "faturamento":
                dados_filiais[i] = obter_fat_mensal(meses, prefixo_key=f"fil{i}")
            else:
                dados_filiais[i] = obter_custo_mensal(meses, prefixo_key=f"fil{i}")
    
    return dados_filiais



def obter_fat_mensal(meses, prefixo_key=""):
    # Garante a existência do contador no session_state
    if 'input_counter' not in st.session_state:
        st.session_state.input_counter = count()
    
    faturamento = {}
    num_colunas = 3
    
    for i in range(0, len(meses), num_colunas):
        cols = st.columns(num_colunas)
        for j, mes in enumerate(meses[i:i+num_colunas]):
            with cols[j]:
                # Chave composta por:
                # 1. Tipo de dado (fixo)
                # 2. Identificador contextual
                # 3. Nome do mês
                # 4. Contador estável por sessão
                unique_key = f"fat_{prefixo_key}_{mes}_{next(st.session_state.input_counter)}"
                
                valor = st.number_input(
                    f"Insira o faturamento de {mes}:",
                    min_value=0,
                    value=st.session_state.get('valores_faturamento', {}).get(mes),  # Mantém estado
                    key=unique_key
                )
                faturamento[mes] = valor
    
    # Atualiza o session_state
    st.session_state.valores_faturamento = faturamento
    return faturamento

def obter_custo_mensal(meses,  sufixo_key=""):
    custo = {}
    num_colunas = 3
    
    for i in range(0, len(meses), num_colunas):
        cols = st.columns(num_colunas)
        for j, mes in enumerate(meses[i:i+num_colunas]): 
            with cols[j]:
                valor = st.number_input(f"inisra o custo de {mes}: ", min_value=0,
                          max_value=99999999999999,
                          step=1,
                          value=None,
                          format="%d",
                          placeholder="por ex: 150000",
                          key=f"custo_{mes}_{sufixo_key}"
                          )
                custo[mes] = valor
    return custo

