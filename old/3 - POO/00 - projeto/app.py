import tkinter as tk
from tkinter import messagebox
from conta import Conta

class Aplicacao:
    def __init__(self, root):
        self.root = root
        self.root.title("Sistema conta corrente")

        self.conta = {}

        tk.Label(root, text="Titular:").grid(row=0, column=0)
        self.entry_titular = tk.Entry(root)
        self.entry_titular.grid(row=0, column=1)

        tk.Label(root, text="Número:").grid(row=1, column=0)
        self.entry_numero = tk.Entry(root)
        self.entry_numero.grid(row=1, column=1)

        tk.Label(root, text="Saldo Inicial:").grid(row=2, column=0)
        self.entry_saldo = tk.Entry(root)
        self.entry_saldo.grid(row=2, column=1)

        tk.Button(root, text="Criar Conta", command=self.criar_conta).grid(row=3, column=0, columnspan=2)

        tk.Label(root, text="Número da conta para transação:").grid(row=4, column=0)
        self.entry_num_trans = tk.Entry(root)
        self.entry_num_trans.grid(row=4, column=1)

        tk.Label(root, text="Número do valor para transação:").grid(row=5, column=0)
        self.entry_num_valor = tk.Entry(root)
        self.entry_num_valor.grid(row=5, column=1)

        tk.Button(root, text="Depositar", command=self.depositar).grid(row=6, column=0)
        tk.Button(root, text="Sacar", command=self.sacar).grid(row=6, column=1)
        tk.Button(root, text="Ver Detalhes", command=self.ver_detalhes).grid(row=7, column=0, columnspan=2)

    def criar_conta(self):
        titular = self.entry_titular.get()
        numero = self.entry_numero.get()
        saldo = float(self.entry_saldo.get() or 0)        

        if numero in self.conta:
            messagebox.showerror("Erro", "Número da conta ja existe...")
            return
        
        self.conta[numero] = Conta(titular, numero, saldo)
        messagebox.showinfo("Sucesso", "Conta criada com sucesso!")


    def depositar(self):
        numero = self.entry_num_trans.get()
        valor = float(self.entry_num_valor.get() or 0)

        if numero in self.conta:
            if self.conta[numero].depositar(valor):
                messagebox.showinfo("sucesso", f"Depósito de R${valor:,.2f} realizado com sucesso!")
            else:
                messagebox.showerror("Erro", " valor inválido para depósito...")
        else:
            messagebox.showerror("erro", "Conta não encontrada!")

    def sacar(self):
        numero = self.entry_num_trans.get()
        valor = float(self.entry_num_valor.get() or 0)

        if numero in self.conta:
            if self.conta[numero].sacar(valor):
                messagebox.showinfo("sucesso", f"Saque de R${valor:,.2f} realizado com sucesso!")
            else:
                messagebox.showerror("Erro", " valor inválido para saque...")
        else:
            messagebox.showerror("erro", "Conta não encontrada!")

    def ver_detalhes(self):
        numero = self.entry_num_trans.get()

        if numero in self.conta:
            detalhes = self.conta[numero].detalhes()
            messagebox.showinfo("Detalhes da Conta", detalhes)
        else:
            messagebox.showerror("erro", "Conta não encontrada!")

# inicialização do app
if __name__ == "__main__":
    root = tk.Tk() 
    app = Aplicacao(root)
    root.mainloop()