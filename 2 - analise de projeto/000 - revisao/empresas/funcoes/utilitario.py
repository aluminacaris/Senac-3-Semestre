import streamlit as st
from config.constantes import meses 

def limpar_dados(tipo):
    st.session_state[f"mostrar_inputs_{tipo}"] = False
    st.session_state[tipo] = {}
    for mes in meses:
        st.session_state.pop(f"{tipo}_{mes}", None)
    st.success(f"Dados de {tipo} apagados.")
    st.rerun
    st.cache