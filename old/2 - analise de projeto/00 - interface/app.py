import streamlit as st
import time

st.markdown("# Seja bem vindo, preencha o formulário!")

# nome = st.text_input("insira seu nome",
#                      placeholder="por ex: joao")

# sobrenome = st.text_input("insira sua data de nascimento",
#                      placeholder="DD")

# nome2 = st.text_input("insira seu nome",
#                      placeholder="por ex: joao")

# nome3 = st.text_input("insira seu nome",
#                      placeholder="por ex: joao")

st.markdown("### Descubra se voce merece aumento!")
salario = st.number_input("insira seu salário",
                          min_value=0,
                          max_value=9999999,
                          step=500,
                          value=None,
                          format="%d",
                          placeholder="digite o numero",
                          key="salario_input")

if st.button("enviar para analise"):
    if salario > 0:
        if salario <= 0:
            st.error("insira um valor maior q 0 bocó")

        elif salario >= 2500:
            st.warning("Seu salário já está bom, não tem aumento para você.")

        else:
            st.success("voce merece aumento! 🎉")
            st.balloons()

            aumento = 0
            salario_att = salario
            progress_bar = st.progress(0)

            while aumento < 500:
                aumento += 100
                salario_att += 100
                progresso = (aumento / 500) * 100
                progress_bar.progress(int(progresso))

                st.write(f"✅ **+ R$100** | **Total  aumentado:** R${aumento} | **Salário atual:** R${salario_att}")
                time.sleep(0.5)  # Delay para visualização 
        
        st.markdown(f"## 🚀 **Salário final após aumento:** R${salario_att}")

    else:
        st.error("insere um valor decente ai mané")

