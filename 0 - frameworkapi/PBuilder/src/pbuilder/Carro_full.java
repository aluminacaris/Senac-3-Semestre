/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package pbuilder;

/**
 *
 * @author suporte
 */
public class Carro_full implements Builder_carro{
    private Carro carro;
    public Carro_full(){
        carro = new Carro();
        //jeito errado
        /*
        
        carro.setMilha(true);
        carro.setRoda(true);
        carro.setSom(true);
        carro.setTeto_solar(true);
        carro.setTrava(true);
        carro.setVidro_eletrico(true);
*/
    }
    @Override
    public void builder_camera(){
        carro.setCamera(true);
    }
    @Override
    public void builder_roda(){
        carro.setRoda(true);
    }
    @Override
    public void builder_trava(){
        carro.setTrava(true);
    }
    @Override
    public void builder_vidro(){
        carro.setVidro_eletrico(true);
    }
    @Override
    public void builder_teto(){
        carro.setTeto_solar(true);
    }
    @Override
    public void builder_som(){
        carro.setSom(true);
    }
    @Override
    public void builder_milha(){
        carro.setMilha(true);
    }
    public Carro getCarro(){
        return carro;
    }
}
