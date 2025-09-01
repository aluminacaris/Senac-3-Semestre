/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package template.metodo;

/**
 *
 * @author maibuk.3988
 */
public abstract class Receita {
    
    public void preparaReceita(){
        if{possuiIngredientes()}{
            preparaIngredientes();
            fazerPrato();
            return;
    }else System.out.println("n tem ingrediente");
    }
    protected abstract boolean possuiIngredientes();
    protected abstract void preparaIngredientes();
    protected abstract void fazerPrato();

