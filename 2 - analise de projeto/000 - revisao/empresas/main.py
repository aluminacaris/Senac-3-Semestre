import streamlit as st

st.set_page_config(initial_sidebar_state="collapsed")

st.title("Página Principal")

col1, col2 = st.columns(2)

# Botão que leva para outra página
with col1:
    if st.button("ver total e media de faturamento, custo e lucro"):
        st.switch_page("pages/lucro.py")  # Nome do arquivo da página

with col2:
    if st.button("ver "):
        st.switch_page("pages/bah.py")  # Nome do arquivo da página

col3, col4 = st.columns(2)

with col3:
    if st.button("no funfa"):
        st.switch_page("pages/lucro.py")  # Nome do arquivo da página

with col4:
    if st.button("noa funciona"):
        st.switch_page("pages/lucro.py")  # Nome do arquivo da página
