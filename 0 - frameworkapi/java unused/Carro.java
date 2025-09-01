package review;

public class Carro extends Veiculo{

    //construtor
    public Carro(String marca, String modelo, int ano) {
        super(marca, modelo, ano);

    }

    // implementando o metodo abstrato de veiculo

    @override
    public void acelerar(){
        system.out.printin("Carro acelerando");
    }

    public void ligar(){
        system.out.printIn("carro ligado");
    }
}