/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package reviewpoo;

/**
 *
 * @author maibuk.3988
 */

/*
    Fabrica sera responsavel por criar objetos de veiculos diferentes 
    a ideia é q vc tenha somente um "tipo" de objeto para referenciar qualquer tipo de veiculo

    isso torna o codigo mais simles, pois nao precisamos criar um tipo caminhao ou tipo carro ou o que fez

    vamos criar um tipo Fabrica para qualquer tipo de veiculo

 */
abstract class Fabrica {
    // metodo abstrato para criar qualquer tipo de veiculo
    // deve ser implementado nas classes fabricas de acordo com os respectivos veiculos
    
    public abstract Veiculo criaVeiculo();
    // verificar a criacao do objeto correto!
    
    public void info() {
        Veiculo v = criaVeiculo();
        v.exibirInfo();
    }
}
