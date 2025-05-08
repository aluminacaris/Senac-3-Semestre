import mysql.connector
import streamlit as st
import pandas as pd
from funcoes.entradas import obter_fat_mensal, obter_custo_mensal, obter_nome_qtd_empresa, obter_dados_por_filial
from funcoes.calculos import calcular_lucro_mensal, calcular_media, verificar_mei
from funcoes.relatorio import mostrar_indicadores, mostrar_resultados
from funcoes.utilitario import limpar_dados
from config.constantes import meses 

if 'input_counter' not in st.session_state:
    from itertools import count
    st.session_state.input_counter = count()

#começar a conectar sql dps

st.markdown("## Calculador de média de lucro, faturamento e custo!")
st.markdown("### insira seu faturamento e custo, depois cliqe ")

st.session_state.nome_empresa, st.session_state.qtd_filiais = obter_nome_qtd_empresa()

default = {
    "mostrar_inputs_fat": False,
    "mostrar_inputs_custo": False,
    "mostrar_inputs_lucro": False,
    "faturamento": {},
    "custo": {},
    "lucro": {},
    "qtd_filiais": 1,
    "nome_empresa": ""
}

for key, value in default.items():
    if key not in st.session_state:
        st.session_state[key] = value

col1, col2, col3 = st.columns(3)

with col1:
    st.button("inserir faturamento", on_click=lambda: st.session_state.update({
        "mostrar_inputs_fat": True,
        "mostrar_inputs_custo": False,
        "mostrar_inputs_lucro": False
    }))

with col2:
        st.button("inserir custo", on_click=lambda: st.session_state.update({
        "mostrar_inputs_fat": False,
        "mostrar_inputs_custo": True,
        "mostrar_inputs_lucro": False

    }))
        
with col3:
    st.button("Verificar lucro", on_click=lambda: st.session_state.update({
        "mostrar_inputs_fat": False,
        "mostrar_inputs_custo": False,
        "mostrar_inputs_lucro": True
    }))

    # st.form("teste"):
    if st.session_state.mostrar_inputs_fat:
            st.subheader("Faturamento por Filial")       
            if st.session_state.qtd_filiais > 1:
                st.info(f"Inserindo dados para {st.session_state.qtd_filiais} filiais")

            tabs = st.tabs([f"Filial {i+1}" for i in range(st.session_state.qtd_filiais)])
                
            faturamento_por_filial = {}
            for i, tab in enumerate(tabs, start=1):
                with tab:
                    faturamento_por_filial[i] = obter_fat_mensal(meses)
            
            st.session_state.faturamento = faturamento_por_filial
        
            if st.button("calcular media de faturamento"):
                media_Fat = calcular_media(st.session_state.faturamento)
                st.success(f"yay dinheiros R${media_Fat:,.2f}")
# ======================================FATURAMENTO=================================


if st.session_state.mostrar_inputs_custo:
    with st.expander("campo de custo", expanded=True):
        st.session_state.custo = obter_custo_mensal(meses)

    if st.button("calcular média de custo"):
        media_custo = calcular_media(st.session_state.custo)
        st.success(f"afff gasto R${media_custo:,.2f}")

# ======================================CUSTO=================================


if st.session_state.mostrar_inputs_lucro:
    with st.expander("Resultados de Lucro", expanded=True):
        # Verifica se existem dados para cálculo
        if not st.session_state.faturamento or not st.session_state.custo:
            st.error("⚠️ Por favor, insira os dados de faturamento E custo primeiro")
        else:
            try:
                # Calcula o lucro
                st.session_state.lucro = calcular_lucro_mensal(
                    st.session_state.faturamento,
                    st.session_state.custo
                )
                
                # Mostra os resultados em formato de tabela
                st.write("### Lucro Mensal")
                for mes, valor in st.session_state.lucro.items():
                    st.write(f"{mes}: R$ {valor:,.2f}")
                
                # Calcula o lucro total
                lucro_total = sum(v for v in st.session_state.lucro.values() if v is not None)
                st.success(f"## Lucro Total: R$ {lucro_total:,.2f}")

                lucro_medio = calcular_media(
                    st.session_state.lucro
                )
                st.success(f"## Lucro médio: R$ {lucro_medio:,.2f}")

                
                # Mostra gráfico (opcional)
                df = pd.DataFrame.from_dict(st.session_state.lucro, orient='index', columns=['Lucro'])
                st.bar_chart(df)
                
            except Exception as e:
                st.error(f"❌ Erro ao calcular: {str(e)}")
# ======================================LUCRO=================================



if st.button("Limpar Tudo", type="primary"):
    limpar_dados("fat")
    limpar_dados("custo")
    st.session_state.mostrar_inputs_lucro = False
    st.success("Todos os dados foram resetados!")
    st.rerun()

if st.button("voltar para a pagina inicial"):
    st.switch_page("main.py")  # Nome do arquivo da página