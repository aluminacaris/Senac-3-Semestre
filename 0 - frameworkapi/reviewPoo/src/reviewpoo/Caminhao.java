/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package reviewpoo;

/**
 *
 * @author maibuk.3988
 */
public class Caminhao extends Veiculo{
    
    private Motor motor;
    
    public Caminhao(String marca, String modelo, int ano, int potencia, int cilindrada) {
        super(marca, modelo, ano);
        this.motor = new Motor(potencia, cilindrada);

    }    

    public int getPotencia(){
        return motor.getPotencia();
    }

    @Override
    public void acelerar() {
       System.out.println("Caminhao acelerando");
    }
    public void ligar(){
        System.out.println("Caminhao ligado");
    }
}
