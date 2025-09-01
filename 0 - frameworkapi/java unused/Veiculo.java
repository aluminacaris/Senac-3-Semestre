package review;

/*
    Classes abstratas:
    são classes que nunca são instanciadas
    Existem apenas para serem modelos para outras classes
    Podem conter metodos abstratos
    São projetadas para serem herdadas
    Metodos abstratos devem ser implementados pelas clases filhas

    Classes abstratas podem ter metodos concretos

    A herança possui uma termologia chamada de polimorfismo
    Polimorfismo é a capacidade de uma classe ter para si metodos e atributos de outra classe

 */
abstract public class Veiculo { //essa classe se torna um modelo para outras classes
    /*
        temos 3 formas de encapsulamento
        private -> acesso somente da classe
        protect -> acesso da propria classe e suas filhas
        public -> acesso de qualquer classe
     */

    protected String marcas;
    protected String modelo;
    protected int ano;

    /*
        contruttores:
        sao metodos especiais que sao usados para incializar objetos em java
        sao chamdos automaticamente
        o objetivo é qie os objetos seja, criados no mesmo instante

        podemos fazer construtores personalizados e mais de um construtor
        quandos fazemos isso, java nao define o construtor principal

        exemplos de construtor personalizados:

        public Veiculo(String marca){
            this.marca = marca;
        }

        public Veiculo(String marca, String modelo){
        this.marca = marca;
        this.modelo = modelo;
        }
     */

    public Veiculo(String marcas, String modelo, int ano) {
        this.marcas = marcas;
        this.modelo = modelo;
        this.ano = ano;
    }

    /*
    public void acelerar(){
        System.out.println("acelerando");
    }
    */

    public abstract void acelerar(); // transformamos em um método abstrato
    //as classes filhas serão obrigadas a implementar

    public void exibirInfo(){
        System.out.println("Marcas: " + this.marcas);
        System.out.println("Modelo: " + this.modelo);
    }

}