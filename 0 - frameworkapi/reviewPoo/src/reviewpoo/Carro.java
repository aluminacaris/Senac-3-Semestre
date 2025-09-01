package reviewpoo;

public class Carro extends Veiculo{
    //variavel pra receber o objeto motor
    private Motor motor;
    //construtor
    public Carro(String marca, String modelo, int ano, int potencia, int cilindrada) {
        super(marca, modelo, ano);
        this.motor = new Motor(potencia, cilindrada);

    }

    public int getPotencia(){
        return motor.getPotencia();
    }
    // implementando o metodo abstrato de veiculo

    @Override
    public void acelerar(){
        System.out.println("Carro acelerando");
    }

    public void ligar(){
        System.out.println("Carro ligado");
    }
}