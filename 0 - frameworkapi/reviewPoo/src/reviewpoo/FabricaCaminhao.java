/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package reviewpoo;

/**
 *
 * @author maibuk.3988
 */
public class FabricaCaminhao extends Fabrica{
    // sobreescrita do metodo pq na classe fabrica esta como metodo abstrato!!!!
    @Override
    public Veiculo criaVeiculo(){
        return new Caminhao("Scania", "Scanner", 2005, 100, 120);
    }
    
}
