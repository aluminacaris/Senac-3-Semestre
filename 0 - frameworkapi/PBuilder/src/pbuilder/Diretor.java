/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pbuilder;

/**
 *
 * @author suporte
 */
public class Diretor {
    private Builder_carro builder;
    
    public Diretor(Builder_carro builder){//
        this.builder=builder;
    }
    public void construir_carro(){
        builder.builder_camera();
        builder.builder_milha();
        builder.builder_roda();
        builder.builder_som();
        builder.builder_teto();
        builder.builder_trava();
        builder.builder_vidro();
    }
    public Carro getCarro(){
        if(builder instanceof Carro_full){
            return ((Carro_full)builder).getCarro();
        }
        return null;
    }
}
