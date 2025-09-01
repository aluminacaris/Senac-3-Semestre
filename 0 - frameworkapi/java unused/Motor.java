package review;

/*
    Conceito de composição
    composição é uma associação de tipo forte entre duas classes
    você pode usaro verbo "ter" para definir a composição, por exemplo
    o carro "tem motor
    Nesse caso, motor sera um atributo de carro
    para isso temos que criar um objeto de outra classe


 */

public class Motor {
    private int potencia;
    private int cilindrada;

    public motor(int potencia, int cilindrada){
        this.potencia = potencia;
        this.cilindrada = cilindrada;
    }

    public void setPotencia(int potencia) {
        this.potencia = potencia;
    }

    public void setCilindrada(int cilindrada) {
        this.cilindrada = cilindrada;
    }

}

