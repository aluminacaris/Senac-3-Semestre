/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package pbuilder;

/**
 *
 * @author suporte
 */
public class PBuilder {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        //Carro c = new Carro();temos que preencher todos os atributos aqui
        //da muito trabalho mesmo sendo só atributos, agora imagine com classes
        //herdadas e composições....
        
        //podemos tirar o construtor e usar os sets e gets 
        //ou ainda criar vários construtores, mesmo assim o trabalho vai ser parecido
        
        //tirando o construtor da classe carro, vamos usar set 
        //Carro c = new Carro();
       // c.setCamera(true);
       // c.setMilha(false);
        //.... deu na mesma

        Diretor diretor = new Diretor(new Carro_full());
        diretor.construir_carro();
        Carro c = diretor.getCarro();
        System.out.println(c.toString());
    }
    
}
