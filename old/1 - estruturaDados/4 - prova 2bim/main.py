import tkinter as tk
from tkinter import messagebox, ttk
import subprocess
import os
import csv

class ClienteApp:
    def __init__(self, root):
        self.root = root
        self.root.title("Sistema de Clientes - Árvore Binária")
        self.root.geometry("800x600")
        
        # Frame principal
        self.main_frame = tk.Frame(root)
        self.main_frame.pack(fill=tk.BOTH, expand=True, padx=10, pady=10)
        
        # Frame do formulário
        self.form_frame = tk.LabelFrame(self.main_frame, text="Dados do Cliente")
        self.form_frame.pack(fill=tk.X, pady=5)
        
        # Campos do formulário
        tk.Label(self.form_frame, text="ID:").grid(row=0, column=0, padx=5, pady=5)
        self.id_entry = tk.Entry(self.form_frame)
        self.id_entry.grid(row=0, column=1, padx=5, pady=5)
        
        tk.Label(self.form_frame, text="Nome:").grid(row=1, column=0, padx=5, pady=5)
        self.nome_entry = tk.Entry(self.form_frame)
        self.nome_entry.grid(row=1, column=1, padx=5, pady=5, sticky=tk.EW)
        
        tk.Label(self.form_frame, text="Email:").grid(row=2, column=0, padx=5, pady=5)
        self.email_entry = tk.Entry(self.form_frame)
        self.email_entry.grid(row=2, column=1, padx=5, pady=5, sticky=tk.EW)
        
        tk.Label(self.form_frame, text="Telefone:").grid(row=3, column=0, padx=5, pady=5)
        self.telefone_entry = tk.Entry(self.form_frame)
        self.telefone_entry.grid(row=3, column=1, padx=5, pady=5, sticky=tk.EW)
        
        # Frame dos botões
        self.button_frame = tk.Frame(self.main_frame)
        self.button_frame.pack(fill=tk.X, pady=5)
        
        self.adicionar_btn = tk.Button(self.button_frame, text="Adicionar", command=self.adicionar_cliente)
        self.adicionar_btn.pack(side=tk.LEFT, padx=5)
        
        self.buscar_btn = tk.Button(self.button_frame, text="Buscar", command=self.buscar_cliente)
        self.buscar_btn.pack(side=tk.LEFT, padx=5)
        
        self.atualizar_btn = tk.Button(self.button_frame, text="Atualizar", command=self.atualizar_cliente)
        self.atualizar_btn.pack(side=tk.LEFT, padx=5)
        
        self.remover_btn = tk.Button(self.button_frame, text="Remover", command=self.remover_cliente)
        self.remover_btn.pack(side=tk.LEFT, padx=5)
        
        self.limpar_btn = tk.Button(self.button_frame, text="Limpar", command=self.limpar_campos)
        self.limpar_btn.pack(side=tk.LEFT, padx=5)
        
        self.exportar_btn = tk.Button(self.button_frame, text="Exportar CSV", command=self.exportar_csv)
        self.exportar_btn.pack(side=tk.RIGHT, padx=5)
        
        # Treeview para exibir clientes
        self.tree_frame = tk.Frame(self.main_frame)
        self.tree_frame.pack(fill=tk.BOTH, expand=True, pady=5)
        
        self.tree = ttk.Treeview(self.tree_frame, columns=("ID", "Nome", "Email", "Telefone"), show="headings")
        self.tree.heading("ID", text="ID")
        self.tree.heading("Nome", text="Nome")
        self.tree.heading("Email", text="Email")
        self.tree.heading("Telefone", text="Telefone")
        
        self.tree.column("ID", width=50)
        self.tree.column("Nome", width=200)
        self.tree.column("Email", width=200)
        self.tree.column("Telefone", width=100)
        
        self.tree.pack(fill=tk.BOTH, expand=True)
        
        self.scrollbar = ttk.Scrollbar(self.tree_frame, orient="vertical", command=self.tree.yview)
        self.scrollbar.pack(side=tk.RIGHT, fill=tk.Y)
        self.tree.configure(yscrollcommand=self.scrollbar.set)
        
        # Carregar dados iniciais
        self.carregar_clientes()
        
        # Configurar seleção na treeview
        self.tree.bind("<ButtonRelease-1>", self.selecionar_cliente)
    
    def executar_comando_c(self, comando, *args):
        try:
            # Compilar o código C se não existir o executável
            if not os.path.exists("arvore_clientes"):
                subprocess.run(["gcc", "arvore_clientes.c", "-o", "arvore_clientes"])
            
            # Executar o comando
            cmd = ["./arvore_clientes", comando] + list(args)
            result = subprocess.run(cmd, capture_output=True, text=True)
            
            if result.returncode != 0:
                messagebox.showerror("Erro", f"Erro ao executar comando C:\n{result.stderr}")
                return None
            
            return result.stdout
        except Exception as e:
            messagebox.showerror("Erro", f"Erro ao executar programa C:\n{str(e)}")
            return None
    
    def carregar_clientes(self):
        # Limpar treeview
        for item in self.tree.get_children():
            self.tree.delete(item)
        
        # Obter clientes do programa C
        output = self.executar_comando_c("listar")
        if output:
            clientes = output.strip().split('\n')
            for cliente in clientes:
                if cliente:
                    dados = cliente.split(',')
                    self.tree.insert("", tk.END, values=dados)
    
    def adicionar_cliente(self):
        id = self.id_entry.get()
        nome = self.nome_entry.get()
        email = self.email_entry.get()
        telefone = self.telefone_entry.get()
        
        if not all([id, nome, email, telefone]):
            messagebox.showwarning("Aviso", "Todos os campos são obrigatórios!")
            return
        
        try:
            id_int = int(id)
        except ValueError:
            messagebox.showerror("Erro", "ID deve ser um número inteiro!")
            return
        
        # Executar comando de inserção no programa C
        self.executar_comando_c("inserir", id, nome, email, telefone)
        self.carregar_clientes()
        self.limpar_campos()
        messagebox.showinfo("Sucesso", "Cliente adicionado com sucesso!")
    
    def buscar_cliente(self):
        id = self.id_entry.get()
        if not id:
            messagebox.showwarning("Aviso", "Digite um ID para buscar!")
            return
        
        try:
            id_int = int(id)
        except ValueError:
            messagebox.showerror("Erro", "ID deve ser um número inteiro!")
            return
        
        # Executar comando de busca no programa C
        output = self.executar_comando_c("buscar", id)
        if output:
            dados = output.strip().split(',')
            if len(dados) == 4:
                self.nome_entry.delete(0, tk.END)
                self.nome_entry.insert(0, dados[1])
                self.email_entry.delete(0, tk.END)
                self.email_entry.insert(0, dados[2])
                self.telefone_entry.delete(0, tk.END)
                self.telefone_entry.insert(0, dados[3])
            else:
                messagebox.showinfo("Informação", "Cliente não encontrado!")
    
    def atualizar_cliente(self):
        id = self.id_entry.get()
        nome = self.nome_entry.get()
        email = self.email_entry.get()
        telefone = self.telefone_entry.get()
        
        if not all([id, nome, email, telefone]):
            messagebox.showwarning("Aviso", "Todos os campos são obrigatórios!")
            return
        
        try:
            id_int = int(id)
        except ValueError:
            messagebox.showerror("Erro", "ID deve ser um número inteiro!")
            return
        
        # Executar comando de atualização no programa C
        self.executar_comando_c("atualizar", id, nome, email, telefone)
        self.carregar_clientes()
        messagebox.showinfo("Sucesso", "Cliente atualizado com sucesso!")
    
    def remover_cliente(self):
        id = self.id_entry.get()
        if not id:
            messagebox.showwarning("Aviso", "Digite um ID para remover!")
            return
        
        try:
            id_int = int(id)
        except ValueError:
            messagebox.showerror("Erro", "ID deve ser um número inteiro!")
            return
        
        if messagebox.askyesno("Confirmar", "Tem certeza que deseja remover este cliente?"):
            # Executar comando de remoção no programa C
            self.executar_comando_c("remover", id)
            self.carregar_clientes()
            self.limpar_campos()
            messagebox.showinfo("Sucesso", "Cliente removido com sucesso!")
    
    def limpar_campos(self):
        self.id_entry.delete(0, tk.END)
        self.nome_entry.delete(0, tk.END)
        self.email_entry.delete(0, tk.END)
        self.telefone_entry.delete(0, tk.END)
    
    def selecionar_cliente(self, event):
        item = self.tree.selection()
        if item:
            valores = self.tree.item(item, "values")
            self.limpar_campos()
            self.id_entry.insert(0, valores[0])
            self.nome_entry.insert(0, valores[1])
            self.email_entry.insert(0, valores[2])
            self.telefone_entry.insert(0, valores[3])
    
    def exportar_csv(self):
        try:
            with open("clientes_exportados.csv", "w", newline='') as f:
                writer = csv.writer(f)
                writer.writerow(["ID", "Nome", "Email", "Telefone"])
                
                for item in self.tree.get_children():
                    valores = self.tree.item(item, "values")
                    writer.writerow(valores)
            
            messagebox.showinfo("Sucesso", "Dados exportados para clientes_exportados.csv")
        except Exception as e:
            messagebox.showerror("Erro", f"Erro ao exportar dados:\n{str(e)}")

if __name__ == "__main__":
    root = tk.Tk()
    app = ClienteApp(root)
    root.mainloop()