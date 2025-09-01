import streamlit as st

if "opcao" not in st.session_state:
    st.session_state['opcao'] = 0

if "boolean" not in st.session_state:
    st.session_state.boolean = False

st.write(st.session_state)

st.write("opcao é: ", st.session_state["opcao"])
st.write("bole é: ", st.session_state.boolean)

for the_key in st.session_state.keys():
    st.write(the_key)

for the_values in st.session_state.values():
    st.write(the_values)

for item in st.session_state.items():
    st.write(item)

button = st.button("Update State")
"before pressing button", st.session_state
if button:
    st.session_state["opcao"] += 1
    st.session_state.boolean = not st.session_state.boolean
    "after pressing button", st.session_state

button2 = st.button("delete td")
if button2:
    for key in st.session_state:
      del st.session_state[key]

st.session_state