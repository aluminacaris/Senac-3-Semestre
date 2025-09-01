# from historico import Historico
import tkinter as tk
from tkinter import messagebox

class Conta:
    def __init__(self, titular, numero, saldo=0.0):
        
        self.saldo = saldo
        self.titular = titular
        self.numero = numero

    def depositar(self, valor):
        if valor > 0:
            self.saldo += valor
            return True
        return False 
    
    def sacar(self, valor):
        if 0 < valor <= self.saldo:
            self.saldo -= valor
            return True
        return False
    
    def detalhes(self):
        return f"Conta: {self.numero}\n Titular: {self.titular}\n Saldo: R${self.saldo:,.2f}"

    

